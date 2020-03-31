<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $this->validateEmail($request);

        $email = $request->input('email',null);

        if($email){
            $user = User::where('email',$email)->first();
            if($user){
                $password = $user->randomPassword();
                $user->password = Hash::make($password);
                $user->save();

                Mail::send('emails.password_change', ['password' => $password, 'user' => $user], function ($m) use ($user) {
                    $email = config('mail.from.address');
                    $m->from($email, 'Karada');
                    $m->to($user->email, $user->first_name . ' ' . $user->last_name)->subject('Смена пароля');
                });

            }else{

            }
        }

        return redirect()->to('/password_reseted');
    }
}
