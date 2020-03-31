<?php

namespace App\Http\Controllers;

use App\Motivation;
use App\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AdminMotivationController extends Controller
{
    public function index($page = 1)
    {
        return view('admin.motivation.list', ['page' => $page]);
    }

    public function getList($page = 1, Request $request)
    {
        $user = Auth::user();

        $page--;

        $limit = 20;
        $offset = $page * $limit;

        $sort_field = $request->input('sort_field', 'created_at');
        $sort_method = $request->input('sort_method', 'asc');

        $page_count = ceil(Motivation::count() / 20);
        $page_list = range(1, $page_count);

        $collections = Motivation::limit($limit)->offset($offset)->orderBy($sort_field, $sort_method)->get();
        foreach ($collections as $key => $value) {
            $video = $value->getVideo();
            if($video) {
                $collections[$key]->video = $video->video;
                $collections[$key]->video_ = $video;
                $collections[$key]->thumb = $video->thumb;
            }
        }

        return response()->json([
            'list' => $collections,
            'page_count' => $page_count,
            'page_list' => $page_list,
            'delete' => ($user->isRole('super admin') || $user->isRole('admin')),
        ]);
    }

    public function uploadVideo(Request $request)
    {
        $files = $request->file('file');

        $result = false;

        foreach ($files as $file) {

            $name = md5($file->getFilename() . date('Y-m-d H:i:s')) . '.' . $file->extension();
            $thumb = md5($file->getFilename() . date('Y-m-d H:i:s')) . '.jpg';

            $file_path = '/videos/' . date('Y-m-d') . '/';

            if (!file_exists(public_path() . $file_path)) {
                mkdir(public_path() . $file_path, 0777, true);
            }

            $command = 'ffmpeg -i ' . $file->getRealPath() . ' -vframes 1 -an -ss 1 ' . public_path($file_path . $thumb);
            exec($command);
            $command = 'ffmpeg -i ' . $file->getRealPath() . ' -s hd720 -c:v libx264 -crf 23 -c:a aac -strict -2 ' . public_path($file_path . '720_' . $name);
            exec($command);
            $command = 'ffmpeg -i ' . $file->getRealPath() . ' -s hd480 -c:v libx264 -crf 23 -c:a aac -strict -2 ' . public_path($file_path . '480_' . $name);
            exec($command);

            $result = Storage::put($file_path . $name, file_get_contents($file->getRealPath()));

            $input = [
                'video' => $file_path . $name,
                'thumb' => $file_path . $thumb,
                'title'=>$file->getClientOriginalName(),
            ];

            $video = Video::create($input);

            $result = Motivation::create([
                'video_id' => $video->id,
                'day' => 1,
            ]);

        }

        return response()->json(['result' => $result]);
    }

    public function update(Request $request)
    {
        $data = $request->all();
        $id = $data['id'];
        unset($data['id']);
        unset($data['video']);
        unset($data['video_']);
        unset($data['thumb']);

        $motivation = Motivation::where('id', $id)->update($data);

        return response()->json(['result' => true]);

    }

    public function delete($id)
    {

        $motivation = Motivation::where('id', $id)->delete();

        return response()->json(['result' => true]);

    }

    public function clone(Request $request)
    {
        $data = $request->all();
        unset($data['id']);
        unset($data['video']);
        unset($data['video_']);
        unset($data['thumb']);

        $motivation = Motivation::create($data);

        return response()->json(['result' => true]);

    }

    public function create(Request $request)
    {
        $data = $request->all();
        unset($data['id']);
        unset($data['video']);
        unset($data['video_']);
        unset($data['thumb']);

        $motivation = Motivation::create($data);

        return response()->json(['result' => true]);
    }

}
