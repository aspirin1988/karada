<?php

namespace App\Http\Controllers;

use App\Lesson;
use App\Media;
use App\Section;
use App\Test;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LessonController extends Controller
{
    public function index($page=1)
    {
        return view('admin.lesson.index',['page'=>$page]);
    }

    public function add()
    {
        return view('admin.lesson.add');
    }

    public function edit($id)
    {
        return view('admin.lesson.edit', ['id' => $id]);
    }

    public function crate(Request $request)
    {
        $data = $request->all();

        $lesson = Lesson::create($data);

        return response()->json($lesson);
    }

    public function getLessonList($page = 1, Request $request)
    {
        $user = Auth::user();

        $page--;
        $sort_field = $request->input('sort_field', 'created_at');
        $sort_method = $request->input('sort_method', 'asc');

        $offset = 20 * $page;

        $page_count = ceil(Lesson::count() / 20);
        $lessons = Lesson::offset($offset)->limit(20)->orderBy($sort_field, $sort_method)->get();

        foreach ($lessons as $key=>$lesson){
            $lessons[$key]->image = $lesson->getThumb();
        }

        $page_list = range(1,$page_count);

        return response()->json([
            'list' => $lessons,
            'page_count' => $page_count,
            'page_list' => $page_list,
            'delete' => ($user->isRole('super admin') || $user->isRole('admin')),
        ]);

    }

    public function getEdit($id)
    {
        $lesson = Lesson::where('id', $id)->first();
        $thumb_lesson_url = Media::where('id', $lesson->thumb)->first();
        $lesson->thumb_url = ($thumb_lesson_url ? $thumb_lesson_url->image : null);
        $lesson->section_ = Section::where('id', $lesson->section_id)->first();
        $lesson->test_ = Test::where('id',$lesson->test_id)->first();
        $lesson->videos = json_decode($lesson->videos, true);
        $lesson->docs = json_decode($lesson->docs, true);

        return response()->json($lesson);
    }

    public function save($id, Request $request)
    {
        $data = $request->all();
        unset($data['thumb_url']);
        unset($data['test_']);
        unset($data['test_']);
        unset($data['section_']);
        $data['videos'] = json_encode($data['videos']);
        $data['docs'] = json_encode($data['docs']);
        $lesson = Lesson::where('id', $id)->update($data);

        return response()->json(['result' => $lesson]);
    }

    public function delete($id)
    {
        $lesson = Lesson::where('id', $id)->delete();

        return response()->json(['result' => $lesson]);
    }
}
