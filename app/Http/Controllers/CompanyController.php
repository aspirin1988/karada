<?php

namespace App\Http\Controllers;

use App\Company;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class CompanyController extends Controller
{
//Route::get('/admin/companies/edit/{id}', 'CompanyController@edit');
//Route::get('/admin/companies/edit/get/{id}', 'CompanyController@getEdit');
//Route::post('/admin/companies/save/{id}', 'CompanyController@save');
//Route::get('/admin/companies/list', 'CompanyController@list');
//Route::get('/admin/companies', 'CompanyController@index');

    public function index($page=1)
    {
        return view('admin.company.list',['page'=>$page]);
    }

    public function add()
    {
        return view('admin.company.add');
    }

    public function edit($id)
    {
        return view('admin.company.edit', ['id' => $id]);

    }

    public function list($page = 1, Request $request)
    {
        $user = Auth::user();

        $page--;
        $sort_field = $request->input('sort_field', 'created_at');
        $sort_method = $request->input('sort_method', 'asc');
        $filter = $request->input('filter', '');
        $offset = 20 * $page;

        $count = Company::count();

        $list = Company::where('name', 'like', "%$filter%")->limit(20)->offset($offset)->orderBy($sort_field, $sort_method)->get();

        $page_count = ceil($count / 20);

        foreach ($list as $key => $value) {
            $list[$key]->cheif = $value->getChief();
            if ($list[$key]->cheif) {
                $list[$key]->cheif->commands = $list[$key]->cheif->getTeam();
                $commands_del = $list[$key]->cheif->getTeamDel();
                foreach ($commands_del as $item) {
                    $list[$key]->cheif->commands[] = $item;
                }
            }
        }

        return response()->json([
            'list' => $list,
            'page_list' => $page_count,
            'delete' => ($user->isRole('super admin') || $user->isRole('admin')),
        ]);

    }

    public function listAll()
    {
        $count = ceil(Company::count() / 20);

        $list = Company::get();


        foreach ($list as $key => $value) {
            $list[$key]->cheif = $value->getChief();
            if ($list[$key]->cheif) {
                $list[$key]->cheif->commands = $list[$key]->cheif->getTeam();
                $commands_del = $list[$key]->cheif->getTeamDel();
                foreach ($commands_del as $item) {
                    $list[$key]->cheif->commands[] = $item;
                }
            }
        }

        return response()->json(['list' => $list]);

    }

    public function getEdit($id)
    {
        $company = Company::where('id', $id)->first();
        $company->cheif = $company->getChief();
        if ($company->cheif) {
            $company->commands = $company->cheif->getTeam();
            $company->commands_del = $company->cheif->getTeamDel();
        }
        return response()->json($company);
    }

    public function create(Request $request)
    {
        $data = $request->all();
        $cheif = $data['cheif'];
        $date_end = $cheif['date_end'];
        unset($data['cheif']);
        unset($cheif['date_end']);
        $password = $this->randomPassword();
        $cheif['active'] = true;
        $cheif['type'] = 'chief';
        $cheif['password'] = Hash::make($password);



        $user = User::create($cheif);
        $company = Company::create($data);
        $user->company_id = $company->id;
        $user->save();
        if ($date_end) {
            $user->addAccess($date_end);
        }

        $user->company_id = $company->id;

        $user->save();

        $file_path = '/images/user/' . $user->id . '/';
        if (!file_exists(public_path() . $file_path)) {
            mkdir(public_path() . $file_path, 0777, true);
        }

        Mail::send('emails.register', ['password' => $password, 'user' => $user], function ($m) use ($user) {
            $email = config('mail.from.address');
            $m->from($email, 'Karada');
            $m->to($user->email, $user->first_name . ' ' . $user->last_name)->subject('Регистрация на сайте "" ');
        });

//        Mail::send('emails.register_user', ['user' => $user], function ($m) use ($user) {
//            $m->from('karada.help@mail.ru', 'Karadau');
            //                $m->to('karada.help@mail.ru', 'Karadau')->subject('Регистрация на сайте "" ');
//            $m->to('vladimir.aiki@gmail.com', 'Karadau')->subject('Регистрация на сайте "" ');
//        });


        return response()->json($company);
    }

    public function delete($id)
    {
        $company = Company::where('id', $id)->first();

        if ($company) {
            $company->deleteUser();
            $company->delete();
        }

        return response()->json(['result' => true]);
    }

    public function save($id, Request $request)
    {
        $data = $request->all();
        $cheif = $data['cheif'];
        unset($data['id']);
        unset($data['commands']);
        unset($data['commands_del']);
        unset($data['cheif']);
        unset($cheif['access_start']);
        unset($cheif['access_end']);
        unset($cheif['command_limit']);
        $cheif_id = $cheif['id'];
//        if (isset($cheif['password']) && $cheif['password']) {
//            $cheif['password'] = Hash::make($cheif['password']);
//        } else {
//            unset($cheif['password']);
//        }
//        unset($cheif['id']);
//        unset($cheif['access_start']);
//        unset($cheif['access_end']);
//        unset($cheif['command_limit']);

        Company::where('id', $id)->update($data);
        User::where('id', $cheif_id)->update($cheif);

        return response()->json($data);
    }

    protected function randomPassword()
    {
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $pass = []; //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass); //turn the array into a string
    }
}
