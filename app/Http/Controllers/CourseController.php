<?php

namespace App\Http\Controllers;

use App\Course;
use App\Media;
use App\Section;
use App\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    public function index()
    {
        return view('admin.courses.index');
    }

    public function add()
    {
        return view('admin.courses.add');
    }

    public function edit($id)
    {
        return view('admin.courses.edit', ['id' => $id]);
    }

    public function crate(Request $request)
    {
        $data = $request->all();

        $course = Course::create($data);

        return response()->json($course);
    }

    public function getCourseAllList()
    {
        $courses = Course::get();
        $page_count = ceil(Course::count() / 20);
        return response()->json([
            'list' => $courses,
            'page_count' => $page_count,
        ]);
    }

    public function getCourseList(Request $request)
    {
        $user = Auth::user();

        $page = $request->input('page', 0);
        $sort_field = $request->input('sort_field', 'created_at');
        $sort_method = $request->input('sort_method', 'asc');
        $offset = 20 * $page;

        $page_count = ceil(Course::count() / 20);
        $courses = Course::offset($offset)->limit(20)->orderBy($sort_field, $sort_method)->get();

        foreach ($courses as $key => $course) {
            $courses[$key]->image = $course->getThumbSection();
        }

        return response()->json([
            'list' => $courses,
            'page_count' => $page_count,
            'delete' => ($user->isRole('super admin') || $user->isRole('admin')),
        ]);

    }

    public function list()
    {
        $data = Course::select('id', 'title')->get();

        return response()->json($data);
    }

    public function getEdit($id)
    {
        $user = Auth::user();

        $course = Course::where('id', $id)->first();

        $thumb_section_url = Media::where('id', $course->thumb_section)->first();
        $course->thumb_section_url = ($thumb_section_url ? $thumb_section_url->image : null);
        $thumb_category_url = Media::where('id', $course->thumb_category)->first();
        $course->thumb_category_url = ($thumb_category_url ? $thumb_category_url->image : null);

        $course->sections = Section::where('course_id', $course->id)->where('parent_id', 0)->get();
        $course->video_ = Video::where('id', $course->video)->first();
        $course->delete = ($user->isRole('super admin') || $user->isRole('admin'));

        return response()->json($course);
    }

    public function save($id, Request $request)
    {
        $data = $request->all();
        unset($data['thumb_section_url']);
        unset($data['thumb_category_url']);
        unset($data['sections']);
        unset($data['delete']);
        unset($data['id']);
        unset($data['video_']);

        $result = Course::where('id', $id)->update($data);

        return response()->json(['result' => $result]);
    }

    public function delete($id)
    {
        $course = Course::where('id', $id)->delete();
        return response()->json($course);
    }
}
