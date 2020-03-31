<?php

namespace App\Http\Controllers\Auth;

use App\PromoCode;
use App\RedisData;
use App\User;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
//            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     * @return \App\User
     */
    protected function create(array $data)
    {


        $password = $this->randomPassword();

        $resource = new RedisData('karada');
        $trial = $resource->getKey('trial', 'limit');
        $price = $resource->getKey('trial', 'price');

        if (isset($data['promo_code'])) {
            $promo_code = PromoCode::where('code', $data['promo_code'])->where('date_end', '>', Carbon::now())->first();
            if ($promo_code) {
                $price = ceil(($price / 100) * (100 - $promo_code->discount));
            }
        }
        $resource->close();
        $user = User::create([
            'first_name' => $data['first_name'],
            'promo_code' => $data['promo_code'] ?? null,
            'last_name' => $data['last_name'],
            'phone' => $data['phone'],
            'email' => $data['email'],
            'city' => $data['city'] ?? null,
            'type' => 'user',
            'price' => $price,
            'password' => Hash::make($password),
        ]);

        $date_end = Carbon::now();
        $date_end->add($trial, 'day');
        $date_end = $date_end->format('Y-m-d');

        $user->addAccess($date_end);

        $file_path = '/images/user/' . $user->id . '/';
        if (!file_exists(public_path() . $file_path)) {
            mkdir(public_path() . $file_path, 0777, true);
        }

        Mail::send('emails.register', ['password' => $password, 'user' => $user], function ($m) use ($user) {
            $email = config('mail.from.address');
            $m->from($email, 'Karada');
//            $m->from('aspirin_1988@mail.ru', 'Sergey');
            $m->to($user->email, $user->first_name . ' ' . $user->last_name)->subject('Регистрация на сайте "" ');
//            $m->to('karada.help@mail.ru', 'Karadau')->subject('Регистрация на сайте "" ');
//            $m->to('vladimir.aiki@gmail.com', 'Karadau')->subject('Регистрация на сайте "" ');
        });

//        Mail::send('emails.register_user', ['user' => $user], function ($m) use ($user) {
//            $m->from('karada.help@mail.ru', 'Karadau');
////            $m->from('aspirin_1988@mail.ru', 'Sergey');
//
//            $m->to('karada.help@mail.ru', 'Karadau')->subject('Регистрация на сайте "" ');
//            $m->to('vladimir.aiki@gmail.com', 'Karadau')->subject('Регистрация на сайте "" ');
//            $m->to('aspirin_1988@mail.ru', 'Karadau')->subject('Регистрация на сайте "" ');
//        });

        return $user;
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
