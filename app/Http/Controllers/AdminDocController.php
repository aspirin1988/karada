<?php

namespace App\Http\Controllers;

use App\Doc;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AdminDocController extends Controller
{

    public function index($page = 1)
    {
        $page--;
        return view('admin.doc.list', ['page' => $page]);
    }

    public function update(Request $request)
    {
        $data = $request->all();
        $id = $data['id'];
        unset($data['id']);

        $doc = Doc::where('id', $id)->update($data);

        return response()->json(['result' => true]);
    }

    public function upload(Request $request)
    {

        $files = $request->file('file');
        $dir = $request->input('dir','docs');

        $result = false;

        foreach ($files as $file) {

            $name = $file->getClientOriginalName();

            $file_path = '/docs/' . $dir . '/' . date('Y-m-d') . '/';

            if (!file_exists(public_path() . $file_path)) {
                mkdir(public_path() . $file_path, 0777, true);
            }


            $result = Storage::put($file_path . $name, file_get_contents($file->getRealPath()));

            $input = [
                'name' => $name,
                'url' => $file_path . $name,
            ];

            Doc::create($input);
        }

        return response()->json(['result' => $result]);

    }

    public function find(Request $request)
    {
        $doc = $request->input('video');

        $docs = Doc::where('name', 'like', '%' . $doc . '%')->get();

        return response()->json($docs);
    }

    public function getList(Request $request)
    {
        $user = Auth::user();

        $sort_field = $request->input('sort_field', 'created_at');
        $sort_method = $request->input('sort_method', 'asc');
        $dir = $request->input('dir','docs');

        $docs = Doc::where('url', 'like', '%/' . $dir . '/%')->orderBy($sort_field, $sort_method)->get();

        return response()->json([
            'list' => $docs,
            'page_list' => [],
            'delete' => ($user->isRole('super admin') || $user->isRole('admin')),
        ]);

    }

    public function getDirectories()
    {
        $img_ = public_path('docs');
        $files = scandir($img_);
        $dir_list = [];
        foreach ($files as $file) {
            if (is_dir($img_ . '/' . $file) && $file != '.' && $file != '..' && $file != '2019-11-17' ) {
                $dir_list[] = $file;
            }
        }
        return response()->json($dir_list);
    }

    public function addDir(Request $request)
    {
        $dir_name = $request->input('dir_name');

        $img_ = public_path('docs');

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

    public function deleteDoc($id)
    {
        $result = Doc::where('id', $id)->delete();

        return response()->json(['result' => $result]);
    }

}
