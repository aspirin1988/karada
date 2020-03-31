<?php

namespace App\Http\Controllers;

use App\PromoCode;
use Illuminate\Http\Request;

class PromoCodeController extends Controller
{
    public function index($page = 0)
    {
        return view('admin.promo_code.index', ['page' => $page]);
    }


    public function getList($page = 1, Request $request)
    {
        $page--;
        $sort_field = $request->input('sort_field', 'created_at');
        $sort_method = $request->input('sort_method', 'asc');
        $offset = 20 * $page;

        $count = ceil(PromoCode::count() / 20);
        $list = PromoCode::limit(20)->offset($offset)->orderBy($sort_field, $sort_method)->get();
        $page_count = ceil($count / 20);

        foreach ($list as $key => $item) {
            $list[$key]->date_end = date('Y-m-d', strtotime($item->date_end));
        }

        return response()->json(['list' => $list, 'page_list' => $page_count]);
    }

    public function create(Request $request)
    {
        $data = $request->all();

        $promocode = PromoCode::create($data);

        return response()->json($promocode);
    }

    public function delete($id)
    {

        $promocode = PromoCode::where('id', $id)->delete();

        return response()->json(['result' => $promocode]);
    }

    public function update(Request $request)
    {
        $data = $request->all();
        $id = $data['id'];
        unset($data['id']);

        $promocode = PromoCode::where('id', $id)->update($data);

        return response()->json($promocode);
    }


}
