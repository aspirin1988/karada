<?php

namespace App\Http\Controllers;

use App\Doc;
use App\Help;
use App\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminHelpController extends Controller
{
    public function index()
    {
        return view('admin.help.list');
    }

    public function edit($id)
    {
        return view('admin.help.edit',['id'=>$id]);
    }

    public function add()
    {
        return view('admin.help.add');
    }

    public function getList()
    {
        $user = Auth::user();

        $help = Help::orderBy('created_at', 'DESC')->get();
//        $help->video_ = Video::where('id', $help->video)->first();
//        foreach ($help as $key => $bonus) {
//            if ($bonus->type == 'video') {
//                $video = Video::where('id', $bonus->video_id)->first();
//
//                $image = '/img/empty.png';
//                $video_ = '';
//
//                if ($video && $video->thumb) {
//                    $image = $video->thumb;
//                    $video_ = $video->video;
//                }
//
//                $help[$key]->image = $image;
//                $help[$key]->video = $video_;
//
//            } else {
//                $doc = Doc::where('id', $bonus->doc_id)->first();
//                $image = '/img/empty.png';
//
//                if ($doc) {
//                    $image = '/images/download.png';
//                }
//                $help[$key]->image = $image;
//            }
//
//        }


        return response()->json([
            'list' => $help,
            'delete' => ($user->isRole('super admin') || $user->isRole('admin')),
        ]);
    }

    public function getEdit($id)
    {
        $help = Help::where('id', $id)->first();

        $help->video_ = $help->getVideo();

        return response()->json($help);
    }

    public function create(Request $request)
    {
        $data = $request->all();
        unset($data['video_']);
        $course = Help::create($data);

        return response()->json($course);

    }

    public function update(Request $request)
    {
        $id = $request->input('id');
        $data = $request->all();
        unset($data['id']);
        unset($data['image']);
        unset($data['video_']);

        $result = Help::where('id', $id)->update($data);

        return response()->json(['result' => $result]);
    }


}
