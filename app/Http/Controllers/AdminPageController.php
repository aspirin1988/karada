<?php

namespace App\Http\Controllers;

use App\Page;
use Illuminate\Http\Request;

class AdminPageController extends Controller
{
    public function page_list($page = 0)
    {
        return view('admin.page.list', ['page' => $page]);
    }

    public function edit($id)
    {
        return view('admin.page.edit', ['id' => $id]);
    }

    public function single($id)
    {
        return view('admin.page.single', ['id' => $id]);
    }

    public function add()
    {
        return view('admin.page.add');
    }

    public function page_list_get($page = 1)
    {
        $page--;
        $offset = $page * 20;
        $page_count = ceil(Page::count() / 20);
        $pages = Page::offset($offset)->limit(20)->get();

        return response()->json([
            'list' => $pages,
            'page_count' => $page_count,
        ]);

    }

    public function addPage(Request $request)
    {
        $data = $request->all();
        $page = Page::create($data);
        $page->makePage();

        return response()->json($page);
    }

    public function getEdit($id)
    {
        $page = Page::where('id', $id)->first();

        return response()->json($page);
    }

    public function saveTemplate($id, Request $request)
    {
        $template = $request->input('template');
        $template_content = $request->input('template_content');

        $page = Page::where('id', $id)->first();

        $result = $page->saveTemplate($template, $template_content);

        return response()->json(['result' => $result]);
    }

    public function getEditTemplate($id, Request $request)
    {
        $template = $request->input('template');

        $page = Page::where('id', $id)->first();

        $template = $page->getTemplate($template);

        return response()->json(['template' => $template]);
    }

    public function save($id, Request $request)
    {
        $data = $request->all();
        unset($data['id']);

        Page::where('id', $id)->update($data);

        return response()->json($data);

    }

}
