<?php

namespace App\Http\Controllers;

use App\Access;
use App\Certificat;
use App\Course;
use App\RedisData;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class AdminUsersController extends Controller
{
    public function index($method = 'solo', $page = 1, Request $request)
    {

        return view('admin.user.list', ['method' => $method, 'page' => --$page]);

    }

    public function add($method)
    {
        return view('admin.user.add', ['method' => $method]);

    }

    public function addCompany($id)
    {
        return view('admin.user.add_company', ['method' => 'company', 'id' => $id]);

    }

    public function edit($id)
    {

        return view('admin.user.edit', ['id' => $id,]);

    }

    public function editAdmin($id)
    {

        return view('admin.user.edit_admin', ['id' => $id,]);

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

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        ]);
    }

    public function addUser(Request $request)
    {
        $data = $request->all();
        $data['password'] = $this->randomPassword();
        $password = $data['password'];

        $validatedData = $request->validate([
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        ]);

        $data['password'] = Hash::make($data['password']);
        $user = User::create($data);
        $resource = new RedisData('karada');
        $trial = (int)$resource->getKey('trial', 'limit');
        $date_end = Carbon::now();
        $date_end->add($trial, 'day');
        $date_end = $date_end->format('Y-m-d');

        $user->addAccess($date_end);

        $file_path = '/images/user/' . $user->id . '/';
        if (!file_exists(public_path() . $file_path)) {
            mkdir(public_path() . $file_path, 0777, true);
        }

        Mail::send('emails.register', ['user' => $user, 'password' => $password], function ($m) use ($data, $user) {
            $email = config('mail.from.address');
            $m->from($email, 'KARADA Школа Продаж');
            $m->to($user->email, $data['first_name'] . ' ' . $data['last_name'])->subject('Регистрация в Школе Продаж KARADA');
        });

//        Mail::send('emails.register_user', ['user' => $user,'password' => $password], function ($m) use ($user) {
//            $m->from('karada.help@mail.ru', 'Karadau');
//                            $m->to('karada.help@mail.ru', 'Karadau')->subject('Регистрация на сайте "" ');
//            $m->to('vladimir.aiki@gmail.com', 'Karadau')->subject('Регистрация на сайте "" ');
//        });

        return response()->json($user);


    }

    public function addUserAccess($id, Request $request)
    {
        $date_end = $request->input('date_end');
        $user = User::where('id', $id)->first();
        $user->addAccess($date_end);

        return response()->json($user);
    }

    public function getEdit($id)
    {
        $user_ = Auth::user();

        $user = User::where('id', $id)->first();

        $user->accsess = Access::where('user_id', $id)->orderBy('updated_at', 'DESC')->first();

        $marketing = Course::where('id', 1)->first();
        $sales = Course::where('id', 2)->first();

        $user->accsess_ = $user->getAccess();
        $user->delete = $user_->isRole('super admin') || $user_->isRole('admin');

        return response()->json($user);
    }


    public function getList($method = 'solo', $page = 0, Request $request)
    {
        $users = [];

        $sort_field = $request->input('sort_field', 'created_at');
        $sort_method = $request->input('sort_method', 'asc');
        $filter = $request->input('filter', '');
        $count = 0;
        switch ($method) {
            case 'all':
                $count = User::count();
                $users = User::orWhere(function ($query) use ($filter) {
                    $query->orWhere('first_name', 'like', "%$filter%");
                    $query->orWhere('last_name', 'like', "%$filter%");
                })->limit(20)->offset($page * 20)->orderBy($sort_field, $sort_method)->get();
                break;
            case 'admins':
                $count = User::orWhere(function ($query) use ($filter) {
                    $query->orWhere('first_name', 'like', "%$filter%");
                    $query->orWhere('last_name', 'like', "%$filter%");
                })->where('is_admin', true)->count();
                $users = User::orWhere(function ($query) use ($filter) {
                    $query->orWhere('first_name', 'like', "%$filter%");
                    $query->orWhere('last_name', 'like', "%$filter%");
                })->where('is_admin', true)->limit(20)->offset($page * 20)->orderBy($sort_field, $sort_method)->get();
                break;
            case 'rop':
                $count = User::orWhere(function ($query) use ($filter) {
                    $query->orWhere('first_name', 'like', "%$filter%");
                    $query->orWhere('last_name', 'like', "%$filter%");
                })->where('is_admin', false)->where('company_id', '>', 0)->where('type', 'chief')->count();
                $users = orWhere(function ($query) use ($filter) {
                    $query->orWhere('first_name', 'like', "%$filter%");
                    $query->orWhere('last_name', 'like', "%$filter%");
                })->where('is_admin', false)->where('company_id', '>', 0)->where('type', 'chief')->limit(20)->offset($page * 20)->orderBy($sort_field, $sort_method)->get();
                break;
            case 'solo':
                $count = User::orWhere(function ($query) use ($filter) {
                    $query->orWhere('first_name', 'like', "%$filter%");
                    $query->orWhere('last_name', 'like', "%$filter%");
                })->where('is_admin', false)->where('company_id', false)->where('type', 'user')->count();
                $users = User::orWhere(function ($query) use ($filter) {
                    $query->orWhere('first_name', 'like', "%$filter%");
                    $query->orWhere('last_name', 'like', "%$filter%");
                })->where('is_admin', false)->where('company_id', false)->where('type', 'user')->limit(20)->offset($page * 20)->orderBy($sort_field, $sort_method)->get();

                break;
        }

        $page_count = ceil($count / 20);

        foreach ($users as $key => $user) {
            $access = Access::where('user_id', $user->id)->where('date_end', '>=', date('Y-m-d'))->orderBy('updated_at', 'DESC')->first();
            if ($access) {
                $users[$key]->access_start = date('Y-m-d', strtotime($user->date_start));
                $users[$key]->access_end = date('Y-m-d', strtotime($user->date_end));
                $users[$key]->command_limit = $user->getCountTeam() . '/' . $user->company_limit;
            }
        }
        $page_list = range(1, $page_count);

        $user = Auth::user();

        return response()->json([
            'list' => $users,
            'page_list' => $page_list,
            'delete' => ($method == "admins" ? $user->isRole('super admin') : ($user->isRole('super admin') || $user->isRole('admin')))
        ]);
    }

    public function save($id, Request $request)
    {
        $data = $request->all();
        unset($data['id']);
        unset($data['accsess']);
        unset($data['delete']);
        unset($data['accsess_']);
        unset($data['progress_marketing']);
        unset($data['progress_sale']);
        if (isset($data['password']) && !empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }
        User::where('id', $id)->update($data);

        return response()->json(['success' => true]);

    }

    public function getListCertificate($id)
    {
        $certificates = Certificat::where('user_id', $id)->get();

        return response()->json($certificates);
    }

    public function lockUser(Request $request)
    {
        $id = $request->input('id');
        $user = User::where('id', $id)->first();
        if ($user) {
            $user->active = false;
            $user->save();
        }

        return response()->json(['result' => true]);
    }

    public function unlockUser(Request $request)
    {
        $id = $request->input('id');
        $user = User::where('id', $id)->first();
        if ($user) {
            $user->active = true;
            $user->save();
        }

        return response()->json(['result' => true]);
    }

    public function delete(Request $request)
    {
        $id = $request->input('id');
        $user = User::where('id', $id)->first();
        if ($user) {
            $user->delete();
        }

        return response()->json(['result' => true]);
    }
}
