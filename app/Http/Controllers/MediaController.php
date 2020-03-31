<?php

namespace App\Http\Controllers;

use App\Image;
use App\Media;
use App\MediaCollection;
use App\MediaCollectionRelation;
use App\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MediaController extends Controller
{
    public function index($dir = 'image', $page = 1)
    {
        return view('admin.media.list', ['dir' => $dir, 'page' => $page]);
    }

    public function video($method = 'all', $page = 1)
    {
        return view('admin.video.list', ['method' => $method, 'page' => $page]);
    }

    public function index_collection($page = 1)
    {
        $page--;
        return view('admin.media.list_collection', ['page' => $page]);
    }

    public function add()
    {
        return view('admin.media.add');
    }

    public function addCollection(Request $request)
    {
        $name = $request->input('name');

        $media_collectoin = MediaCollection::create(['name' => $name]);

        return response()->json($media_collectoin);

    }

    public function edit_collection($id)
    {
        return view('admin.media.edit', ['id' => $id]);
    }

    public function getMedia($id)
    {
        $media_collectoin = MediaCollection::where('id', $id)->first();

        $media = $media_collectoin->getMedia();

        return response()->json($media);
    }

    public function uploadMedia($id, Request $request)
    {
        $media_collection = MediaCollection::where('id', $id)->first();

        $files = $request->file('file');

        $result = false;

        foreach ($files as $file) {

            $name = md5($file->getFilename() . date('Y-m-d H:i:s')) . '.' . $file->extension();

            $result = $media_collection->uploadFile($name, $file);
        }

        return response()->json(['result' => $result]);
    }

    public function upload(Request $request)
    {

        $files = $request->file('file');

        $dir = $request->input('dir', 'image');


        $result = false;
        $media = [];

        foreach ($files as $file) {

            $name = md5($file->getFilename() . date('Y-m-d H:i:s')) . '.' . $file->extension();

            $file_path = '/images/' . $dir . '/' . date('Y-m-d') . '/';

            if (!file_exists(public_path() . $file_path)) {
                mkdir(public_path() . $file_path, 0777, true);
            }

            $result = Storage::put($file_path . $name, file_get_contents($file->getRealPath()));

            $input = [
                'image' => $file_path . $name,
            ];

            $media = Media::create($input);
        }

        return response()->json(['result' => $result, 'media' => $media]);
    }

    public function mediaUpdate($id, Request $request)
    {
        $data = $request->all();
        unset($data['id']);
        unset($data['created_at']);
        unset($data['updated_at']);
        $media = Media::where('id', $id)->update($data);

        return response()->json(['result' => $media]);
    }

    public function delete_image($c_id, $i_id)
    {
        $result = MediaCollectionRelation::where('collection_id', $c_id)->where('media_id', $i_id)->delete();

        return response()->json(['result' => $result]);
    }

    public function deleteImage($i_id)
    {
        $result = MediaCollectionRelation::where('media_id', $i_id)->delete();
        $result = Media::where('id', $i_id)->delete();

        return response()->json(['result' => $result]);
    }

    public function deleteVideo($id)
    {
        $result = Video::where('id', $id)->delete();

        return response()->json(['result' => $result]);
    }


    public function getCollection($page = 0)
    {
        $limit = 200;
        $offset = $page * $limit;

        $collections = MediaCollection::limit($limit)->offset($offset)->get();

        return response()->json(['list' => $collections]);
    }

    public function getMediaList($dir = 'image', $page = 1, Request $request)
    {
        $user = Auth::user();

        $sort_field = $request->input('sort_field', 'created_at');
        $sort_method = $request->input('sort_method', 'asc');

        $limit = 50;
        $offset = ($page - 1) * $limit;

        $media = Media::where('image', 'like', '%/' . $dir . '/%')->limit($limit)->offset($offset)->orderBy($sort_field, $sort_method)->get();
        $media_count = Media::where('image', 'like', '%/' . $dir . '/%')->count();

        if ($media_count > 1) {
            $media_count = ceil($media_count / $limit);
            $media_count = range(1, $media_count);
        } else {
            $media_count = [1];
        }

        return response()->json([
            'list' => $media,
            'page_list' => $media_count,
            'delete' => ($user->isRole('super admin') || $user->isRole('admin')),
        ]);
    }

    public function getMediaListAll($dir = 'image', Request $request)
    {
        $sort_field = $request->input('sort_field', 'created_at');
        $sort_method = $request->input('sort_method', 'asc');

        $media = Media::where('image', 'like', '%/' . $dir . '/%')->orderBy($sort_field, $sort_method)->get();

        return response()->json(['list' => $media]);
    }

    public function getAll()
    {
        $media = Media::get();
        return response()->json(['images' => $media]);
    }

    public function updateSort($id, Request $request)
    {
        $sort = $request->input('sort');
        $rel = MediaCollectionRelation::where('id', $id)->update(['order_field' => $sort]);

        return $rel;
    }

    public function getVideoList($method = 'all', $page = 1, Request $request)
    {
        $user = Auth::user();

        $dir = $request->input('dir');
        $sort_field = $request->input('sort_field', 'created_at');
        $sort_method = $request->input('sort_method', 'asc');
        $limit = 50;
        $offset = ($page - 1) * $limit;

        $collections = Video::where('video', 'like', '%/' . $dir . '/%')->limit($limit)->offset($offset)->orderBy($sort_field, $sort_method)->get();
        $collections_count = Video::where('video', 'like', '%/' . $dir . '/%')->count();
        if ($collections_count > 1) {
            $collections_count = ceil($collections_count / $limit);
            $collections_count = range(1, $collections_count);
        } else {
            $collections_count = [1];
        }

        return response()->json([
            'list' => $collections,
            'page_list' => $collections_count,
            'delete' => ($user->isRole('super admin') || $user->isRole('admin')),
        ]);
    }

    public function updateVideo(Request $request)
    {
        $data = $request->all();
        $id = $data['id'];
        unset($data['id']);

        $video = Video::where('id', $id)->update($data);

        return response()->json(['result' => true]);

    }

    public function uploadVideo(Request $request)
    {
        $files = $request->file('file');
        $dir = $request->input('dir', 'video');

        $result = false;

        $video = null;
        foreach ($files as $file) {

            $name = md5($file->getFilename() . date('Y-m-d H:i:s')) . '.' . $file->extension();
            $thumb = md5($file->getFilename() . date('Y-m-d H:i:s')) . '.jpg';

            $file_path = '/videos/' . $dir . '/' . date('Y-m-d') . '/';

            if (!file_exists(public_path() . $file_path)) {
                mkdir(public_path() . $file_path, 0777, true);
            }

            $command = 'ffmpeg -i ' . $file->getRealPath() . ' -vframes 1 -an -s 1920x1080 -ss 0 ' . public_path($file_path . $thumb);
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
        }

        return response()->json(['result' => $result, 'video' => $video]);
    }

    public function findVideo(Request $request)
    {
        $video = $request->input('video');

        $videos = Video::where('title', 'like', '%' . $video . '%')->get();

        return response()->json($videos);


    }

    public function getDirectories()
    {
        $img_ = public_path('images');
        $files = scandir($img_);
        $dir_list = [];
        foreach ($files as $file) {
            if (is_dir($img_ . '/' . $file) && $file != '.' && $file != '..' && $file != 'user') {
                $dir_list[] = $file;
            }
        }
        return response()->json($dir_list);
    }

    public function addDir(Request $request)
    {
        $dir_name = $request->input('dir_name');

        $img_ = public_path('images');

        if (!file_exists($img_ . '/' . $dir_name)) {
            mkdir($img_ . '/' . $dir_name, 0777, true);
        }

        $files = scandir($img_);

        $dir_list = [];

        foreach ($files as $file) {
            if (is_dir($img_ . '/' . $file) && $file != '.' && $file != '..') {
                $dir_list[] = $file;
            }
        }

        return response()->json($dir_list);

    }

    public function getDirectoriesVideo()
    {
        $img_ = public_path('videos');
        $files = scandir($img_);
        $dir_list = [];
        foreach ($files as $file) {
            if (is_dir($img_ . '/' . $file) && $file != '.' && $file != '..' && $file != '2019-11-05' && $file != '2019-11-08' && $file != '2019-12-21') {
                $dir_list[] = $file;
            }
        }
        return response()->json($dir_list);
    }

    public function addDirVideo(Request $request)
    {
        $dir_name = $request->input('dir_name');

        $img_ = public_path('videos');

        if (!file_exists($img_ . '/' . $dir_name)) {
            mkdir($img_ . '/' . $dir_name, 0777, true);
        }

        $files = scandir($img_);

        $dir_list = [];

        foreach ($files as $file) {
            if (is_dir($img_ . '/' . $file) && $file != '.' && $file != '..' && $file != '2019-11-05' && $file != '2019-11-08' && $file != '2019-12-21') {
                $dir_list[] = $file;
            }
        }

        return response()->json($dir_list);

    }


}
