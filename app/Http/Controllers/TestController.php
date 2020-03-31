<?php

namespace App\Http\Controllers;

use App\Question;
use App\RedisData;
use App\Test;
use App\TestQuestion;
use App\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TestController extends Controller
{
    public function getList()
    {
        $tests = Test::get();

        return response()->json($tests);
    }

    public function getList_($page = 1, Request $request)
    {
        $user = Auth::user();

        $page--;
        $sort_field = $request->input('sort_field', 'created_at');
        $sort_method = $request->input('sort_method', 'asc');
        $offset = 20 * $page;

        $page_count = ceil(Test::count() / 20);

        $tests = Test::limit(20)
            ->offset($offset)
            ->orderBy($sort_field, $sort_method)
            ->get();

        $page_list = range(1, $page_count);

        return response()->json([
            'list' => $tests,
            'page_count' => $page_count,
            'page_list' => $page_list,
            'delete' => ($user->isRole('super admin') || $user->isRole('admin')),
        ]);
    }

    public function index($page = 1)
    {
        return view('admin.test.list', ['page' => $page]);
    }

    public function add()
    {
        return view('admin.test.add');

    }

    public function edit($id)
    {
        return view('admin.test.edit', ['id' => $id]);

    }


    public function addTest(Request $request)
    {
        $data = $request->all();

        $test = Test::create($data);

        return response()->json($test);
    }

    public function getQuestions($id)
    {
        $test = Test::where('id', $id)->first();

        $questions = $test->getQuestions();

        return response()->json($questions);

    }

    public function getQuestion($id)
    {
        $question = TestQuestion::where('id', $id)->first();

        $question->answers = json_decode($question->answers);

        return response()->json($question);

    }

    public function save($id, Request $request)
    {
        $id = $request->input('id');
        $data = $request->all();
        unset($data['id']);
        $test = Test::where('id', $id)->update($data);

        return response()->json(['result' => $test]);

    }

    public function saveQuestion($id, Request $request)
    {
        $data = $request->all();
        $data['answers'] = json_encode($data['answers']);
        $question = TestQuestion::where('id', $id)->update($data);

        return response()->json(['result' => $question]);

    }

    public function addQuestion($id, Request $request)
    {
        $data = $request->all();
        $data['test_id'] = $id;
        $data['answers'] = json_encode($data['answers']);

        $question = TestQuestion::create($data);

        $test = Test::where('id', $id)->first();
        $questions = $test->getQuestions();


        return response()->json($questions);

    }

    public function getEdit($id)
    {
        $test = Test::where('id', $id)->first();
        return response()->json($test);

    }

    public function ajaxTest($id)
    {
        $test = Test::where('id', $id)->first();
        $test->results = json_decode($test->results);
        $test->questions = $test->getQuestions();
        foreach ($test->questions as $key => $value) {
            $test->questions[$key]->answers = json_decode($value->answers);

            $test->questions[$key] = $test->questions[$key]->PregApi();
        }
        return response()->json($test);
    }

    public function ajaxTestSet(Request $request)
    {
        $id = $request->input('id');
        $lesson_id = $request->input('lesson_id');
        $status = $request->input('success');

        $user_id = Auth::id();

        $resource = new RedisData('karada');
        $key = "user_{$user_id}:stat:lesson_" . $lesson_id . ':test';
        $result = $resource->setKey((int)$status, $key, $id);

        $resource->close();
        return [$result, $key . ':' . $id];

    }

    public function find(Request $request)
    {
        $test = $request->input('test');

        $tests = Test::where('title', 'like', '%' . $test . '%')->get();

        return response()->json($tests);
    }

    public function delete($id)
    {
        $result = Test::where('id', $id)->delete();

        return response()->json(['result' => $result]);
    }

//    public function getList($page)
//    {
//        $tests=Test::limit(20)->offset($page*20)->get();
//
//        return response()->json(['list' => $tests, 'page_list' => []]);
//    }
}
