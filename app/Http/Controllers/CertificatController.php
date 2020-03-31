<?php

namespace App\Http\Controllers;

use App\Certificat;
use App\Diploma;
use App\Section;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CertificatController extends Controller
{
    public function index($page = 1)
    {
        return view('admin.certificate.list', ['page' => $page]);
    }

    public function getList($page = 1, Request $request)
    {
        $sort_field = $request->input('sort_field', 'created_at');
        $sort_method = $request->input('sort_method', 'asc');
        $filter = $request->input('filter', 99999);
        $filter_name = $request->input('filter_name', 99999);

        $limit = 20;
        $page--;

        $offset = $limit * $page;
        $certificate_count = Certificat::count();
        $page_count = ceil($certificate_count / $limit);

        $certificate = Certificat::where(function ($query) use ($filter, $filter_name) {
            if ($filter !== 99999) {
                $query->where('section_id', $filter);
            }
            if ($filter_name !== '') {
                $query->where('user_name', 'like', '%' . $filter_name . '%');
            }
        })->offset($offset)->limit($limit)->orderBy('certificats.' . $sort_field, $sort_method)->get();

        $diplomas = Diploma::where(function ($query) use ($filter, $filter_name) {
            if ($filter_name !== '') {
                $query->where('user_name', 'like', '%' . $filter_name . '%');
            }
        })->offset($offset)->limit($limit)->orderBy('diplomas.' . $sort_field, $sort_method)->get();

        foreach ($certificate as $key => $item) {
//            $user= User::where('id',$item->user_id)->first();
//            $certificate[$key]->user_name = $user->first_name.' '.$user->last_name;
//            $date = explode(' ',$certificate[$key]->created_at);
//            $date = array_shift($date);
//            $certificate[$key]->created_at = $date;

            if ($item->section_id) {
                $section = Section::where('id', $item->section_id)->first();
                $certificate[$key]->section_title = $section->title;
            }
        }

        foreach ($diplomas as $key => $item) {
            $item->section_title = 'Диплом за курс';
            $certificate[] = $item;
        }

        $page_list = range(1, $page_count);

        return response()->json(['list' => $certificate, 'page_list' => $page_list]);

    }
}
