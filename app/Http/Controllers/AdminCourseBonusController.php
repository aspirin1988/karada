<?php

namespace App\Http\Controllers;

use App\CourseBonus;
use App\Doc;
use App\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminCourseBonusController extends Controller
{
    public function index($page = 1)
    {
        return view('admin.course_bonus.list', ['page' => $page]);
    }

    public function add()
    {
        return view('admin.course_bonus.add');
    }

    public function getList($page = 1, Request $request)
    {
        $user = Auth::user();

        $page--;
        $sort_field = $request->input('sort_field', 'created_at');
        $sort_method = $request->input('sort_method', 'asc');
        $offset = 20 * $page;

        $page_count = ceil(CourseBonus::count() / 20);

        $course_bonus = CourseBonus::limit(20)
            ->offset($offset)
            ->orderBy($sort_field, $sort_method)
            ->get();

        $page_list = range(1, $page_count);


        foreach ($course_bonus as $key => $bonus) {
            if ($bonus->type == 'video') {
                $video = Video::where('id', $bonus->video_id)->first();

                $image = '/img/empty.png';
//                $video_ = '';

                if ($video && $video->thumb) {
                    $image = $video->thumb;
//                    $video_ = $video->video;
                }

                $course_bonus[$key]->image = $image;
                $course_bonus[$key]->video = $video;

            } else {
                $doc = Doc::where('id', $bonus->doc_id)->first();
                $image = '/img/empty.png';

                if ($doc) {
                    $image = '/images/download.png';
                }
                $course_bonus[$key]->image = $image;
                $course_bonus[$key]->doc = $doc;
            }

        }


        return response()->json([
            'list' => $course_bonus,
            'page_count' => $page_count,
            'page_list' => $page_list,
            'delete' => ($user->isRole('super admin') || $user->isRole('admin')),
        ]);
    }

    public function create(Request $request)
    {
        $data = $request->all();
        unset($data['video_title']);
        unset($data['doc_title']);
        unset($data['video']);
        unset($data['doc']);

        $course = CourseBonus::create($data);

        return response()->json($course);

    }

    public function update(Request $request)
    {
        $id = $request->input('id');
        $data = $request->all();
        unset($data['id']);
        unset($data['image']);
        unset($data['video']);
        unset($data['doc']);

        $result = CourseBonus::where('id', $id)->update($data);

        return response()->json(['result' => $result]);
    }

    public function delete($id)
    {
        $result = CourseBonus::where('id', $id)->delete();

        return response()->json(['result' => $result]);
    }


}
