<?php

namespace App\Http\Controllers;

use App\ArbitraryFields;
use App\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function page($slug)
    {


        $page = Page::where('slug', $slug)->where('status', true)->first();
        if (!$page) {
            return abort(404);
        }
        $data = ArbitraryFields::where('object_type', 'page')->where('object_id', $page->id)->first();
        $result = [];
        if ($data) {
            $fields = json_decode($data->fields, true);
            foreach ($fields as $item) {
                $result[$item['key']] = $item['value'];
            }
        }

        $template_path = "pages." . $slug . '.index';

        return view($template_path, ['fields' => $result, 'test' => 'test']);
    }
}
