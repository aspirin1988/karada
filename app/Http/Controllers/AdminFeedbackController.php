<?php

namespace App\Http\Controllers;

use App\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminFeedbackController extends Controller
{
    public function index($page = 0)
    {
        return view('admin.feedback.index', ['page' => $page]);
    }

    public function add()
    {
        return view('admin.feedback.add');
    }

    public function getList($page = 0)
    {
        $page--;
        $offset = $page * 20;
        $page_count = ceil(Feedback::count() / 20);
        $pages = Feedback::offset($offset)->limit(20)->get();

        return response()->json([
            'list' => $pages,
            'page_count' => $page_count,
        ]);
    }

    public function addFeedback(Request $request)
    {
        $data = $request->all();

        $feedback = Feedback::create($data);

        return response()->json($feedback);
    }

    public function edit($id)
    {
        return view('admin.feedback.edit', ['id' => $id]);
    }

    public function getEdit($id)
    {
        $feedback = Feedback::where('id', $id)->first();

        return response()->json($feedback);
    }

    public function save($id, Request $request)
    {
        $data = $request->all();
        unset($data['id']);
        unset($data['created_at']);
        unset($data['updated_at']);
        $feedback = Feedback::where('id', $id)->update($data);

        return response()->json($feedback);
    }

    public function upload(Request $request)
    {
        $file = $request->file('file');

        $name = md5($file->getFilename() . date('Y-m-d H:i:s')) . '.' . $file->extension();

        $file_path = '/images/image/' . date('Y-m-d') . '/';

        if (!file_exists(public_path() . $file_path)) {
            mkdir(public_path() . $file_path, 0777, true);
        }

        $result = Storage::put($file_path . $name, file_get_contents($file->getRealPath()));

        return response()->json(['result' => $result, 'image' => $file_path . $name]);
    }
}
