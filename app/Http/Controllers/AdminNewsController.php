<?php

namespace App\Http\Controllers;

use App\News;
use App\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AdminNewsController extends Controller
{
    public function index($page = 1)
    {
        $page--;
        return view('admin.news.list', ['page' => $page]);
    }

    public function getList($method = 'all', $page = 0, Request $request)
    {
        $user = Auth::user();

        $sort_field = $request->input('sort_field', 'created_at');
        $sort_method = $request->input('sort_method', 'asc');

        $limit = 20;
        $offset = $page * $limit;

        $count = News::count();

        $collections = News::limit($limit)->offset($offset)->orderBy($sort_field, $sort_method)->get();
        foreach ($collections as $key => $value) {
            if ($value->type == 'doc') {
                $doc = $value->getDoc();
                if ($doc) {
                    $collections[$key]->doc = $doc;
                    $collections[$key]->doc_title = $doc->name;
                    $collections[$key]->thumb = '/images/download.png';

                }
            } else {
                $video = $value->getVideo();

                if ($video) {
                    $collections[$key]->video = $video->video;
                    $collections[$key]->video_title = $video->title;
                    $collections[$key]->thumb = $video->thumb;
                }
            }
        }

        return response()->json([
            'list' => $collections,
            'page_list' => range(1, ceil($count / $limit)),
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
                'title' => $file->getClientOriginalName(),
            ];

            $video = Video::create($input);

            News::create([
                'video_id' => $video->id,
            ]);

        }

        return response()->json(['result' => $result]);
    }

    public function create(Request $request)
    {
        $data = $request->all();
        unset($data['video']);
        unset($data['thumb']);
        unset($data['video_title']);

        $news = News::create($data);

        return response()->json(['result' => true]);

    }

    public function update(Request $request)
    {
        $data = $request->all();
        $id = $data['id'];
        unset($data['id']);
        unset($data['video']);
        unset($data['thumb']);
        unset($data['video_title']);
        unset($data['doc_title']);
        unset($data['doc']);

        $news = News::where('id', $id)->update($data);

        return response()->json(['result' => true]);

    }

    public function delete($id)
    {
        $news = News::where('id', $id)->first();
        if ($news) {
            return response()->json(['result' => $news->delete()]);
        }
    }

}

