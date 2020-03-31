<?php

namespace App\Http\Controllers;

use App\Course;
use App\Lesson;
use App\Media;
use App\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SectionController extends Controller
{
    public function index()
    {
        return view('admin.section.index');
    }

    public function add()
    {
        return view('admin.section.add');
    }

    public function edit($id)
    {
        return view('admin.section.edit', ['id' => $id]);
    }

    public function crate(Request $request)
    {
        $data = $request->all();

        $section = Section::create($data);

        return response()->json($section);
    }

    public function list()
    {
        $data = Section::select('id', 'title')->get();

        return response()->json($data);
    }

    public function listParent()
    {
        $data = Section::select('id', 'title')->where('parent_id', 0)->get();

        return response()->json($data);
    }

    public function getSectionList($course_id = 0)
    {
        $user = Auth::user();

        $section = Section::where('parent_id', 0)->where('course_id', $course_id)->orderBy('sort', 'desc')->get();
        foreach ($section as $key => $value) {
            $section[$key]->image = $value->getThumb();
            $section[$key]->child = $value->getChild();

            foreach ($section[$key]->child as $key_ => $value_) {
                $section[$key]->child[$key_]->image = $value_->getThumb();
            }
        }

        return response()->json([
            'list' => $section,
            'page_count' => 0,
            'delete' => ($user->isRole('super admin') || $user->isRole('admin')),
        ]);

    }

    public function getEdit($id)
    {
        $section = Section::where('id', $id)->first();
        $thumb_section_url = Media::where('id', $section->thumb)->first();
        $thumb_category_url = Media::where('id', $section->thumb_category)->first();
        $section->thumb_url = ($thumb_section_url ? $thumb_section_url->image : null);
        $section->thumb_category_url = ($thumb_category_url ? $thumb_category_url->image : null);

        $section->lessons = Lesson::where('section_id', $section->id)->get();
        $section->sections = Section::where('parent_id', $section->id)->get();


        return response()->json($section);
    }

    public function save($id, Request $request)
    {
        $data = $request->all();
        unset($data['thumb_url']);
        unset($data['thumb_category_url']);
        unset($data['lessons']);
        unset($data['sections']);

        $section = Section::where('id', $id)->update($data);

        return response()->json(['result' => $section]);
    }

    public function updateSort($method, Request $request)
    {
        $result = false;

        $id = $request->input('id');
        $section = Section::where('id', $id)->first();
        if ($section) {
            if ($method == 'up') {
                $section->sort++;
                $result = $section->save();
            }
            if ($method == 'down') {
                $section->sort--;
                $result = $section->save();
            }
        }

        return response()->json(['result' => $result]);
    }

    public function find(Request $request)
    {
        $section = $request->input('section');
        $sections = Section::where('title', 'like', '%' . $section . '%')->get();

        return response()->json($sections);
    }

    public function delete($id)
    {
        $section = Section::where('id', $id)->delete();
        return response()->json($section);
    }
}
