<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use phpDocumentor\Reflection\DocBlock\Tags\Generic;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'phone', 'email', 'password', 'type', 'accsess_', 'accsess', 'promo_code', 'city', 'price', 'company_id', 'job', 'company_limit', 'is_admin'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function isAdmin()
    {
        return boolval($this->is_admin);
    }

    public function isSolo()
    {

        return boolval(!$this->company_id && $this->isRole('user'));
    }

    public function isActive()
    {
        return boolval($this->active);
    }

    public function isRole($role)
    {
        return boolval($this->type == $role);
    }

    public function getDay()
    {
        $date = date('Y-m-d', strtotime($this->created_at));
        $day = (int)ceil((time() - strtotime($date)) / (60 * 60 * 24));

        return $day;
    }

    public function getAva()
    {
        return $this->ava;
    }

    public function getBackground()
    {
        return $this->background;
    }

    public function getUserStat()
    {
        $stat = UserStat::where('user_id', $this->id)->first();


        if (!is_object($stat)) {
            $stat = new  UserStat();

            $stat->user_id = $this->id;
            $stat->marketing = 0;
            $stat->sales = 0;
            $stat->personal_goals = 0;
            $stat->sales_plan = 0;
            $stat->save();
        }

        return $stat;
    }

    public function getPersonalGoalsStat()
    {
        $personal_goals_complete = PersonalGoal::where('user_id', $this->id)->where('status', '1')->count();

        $personal_goals = PersonalGoal::where('user_id', $this->id)->count();

        $percent = 0;
        if ($personal_goals) {
            $percent = ceil(($personal_goals_complete / $personal_goals) * 100);
        }


        return $percent;
    }

    public function getPlan()
    {
        $sales_plan = SalesPlan::where('user_id', $this->id)->where('year', date('Y'))->where('month', date('m'))->orderBy('id')->first();

        return $sales_plan;
    }

    public function getSalesPlanStat()
    {
        $sales_plan = SalesPlan::where('user_id', $this->id)->where('year', date('Y'))->where('month', date('m'))->orderBy('id')->first();
        if ($sales_plan) {
            return $sales_plan->getPercent();
        } else {
            return 0;
        }
    }

    public function getPlans()
    {
        $sales_plan = SalesPlan::where('user_id', $this->id)->orderBy('id')->limit(12)->get();

        return $sales_plan;
    }

    public function getPlansByQuarter()
    {
        $quarter_plan = [];
        $quarter_plan_item = [
            1 => [
                'item' => [
                    1 => null,
                    2 => null,
                    3 => null,
                ],
                'count' => 0,
                'plan' => 0,
                'fact' => 0,
            ],
            2 => [
                'item' => [
                    4 => null,
                    5 => null,
                    6 => null,
                ],
                'count' => 0,
                'plan' => 0,
                'fact' => 0,
            ],
            3 => [
                'item' => [
                    7 => null,
                    8 => null,
                    9 => null,
                ],
                'count' => 0,
                'plan' => 0,
                'fact' => 0,
            ],
            4 => [
                'item' => [
                    10 => null,
                    11 => null,
                    12 => null,
                ],
                'count' => 0,
                'plan' => 0,
                'fact' => 0,
            ],
        ];

        $sales_plans_years = SalesPlan::select('year')->distinct()->where('user_id', $this->id)->limit(12)->get();
        foreach ($sales_plans_years as $year) {
            $quarter_plan[$year->year] = $quarter_plan_item;
        }


        $sales_plans = SalesPlan::where('user_id', $this->id)->orderBy('id')->limit(12)->get();


        foreach ($sales_plans as $plan) {

            $quarter_plan[$plan->getYear()][$plan->getQuarter()]['count']++;
            $quarter_plan[$plan->getYear()][$plan->getQuarter()]['item'][$plan->getMonthNum()] = $plan;
            $quarter_plan[$plan->getYear()][$plan->getQuarter()]['plan'] = $quarter_plan[$plan->getYear()][$plan->getQuarter()]['plan'] + $plan->getPlan();
            $quarter_plan[$plan->getYear()][$plan->getQuarter()]['fact'] = $quarter_plan[$plan->getYear()][$plan->getQuarter()]['fact'] + $plan->getFact();
        }

//        dd($quarter_plan);


//        foreach ($quarter_plan as $key => $plan) {
//            if (count($plan) < 4) {
//
//            }
//        }


        return $quarter_plan;
    }

    public function updatePlansByQuarter($year, $quarter, $plan)
    {
        $quarter_plan_item = [
            1 => [1, 2, 3],
            2 => [4, 5, 6],
            3 => [7, 8, 9],
            4 => [10, 11, 12],
        ];

        $quarter = $quarter_plan_item[$quarter];

        $count = SalesPlan::where('user_id', $this->id)->where('year', $year)->whereIn('month', $quarter)->count();

        $plan_mont = ceil($plan / $count);

        $update = SalesPlan::where('user_id', $this->id)->where('year', $year)->whereIn('month', $quarter)->update(['plan' => $plan_mont]);

        return $update;
    }

    public function getPlansSum()
    {
        $sales_plan = SalesPlan::where('user_id', $this->id)->orderBy('id')->limit(12)->sum('plan');

        return $sales_plan;
    }

    public function getFactSum()
    {
        $sales_plan = SalesPlan::where('user_id', $this->id)->orderBy('id')->limit(12)->sum('fact');

        return $sales_plan;
    }

    public function addAccess($date_end)
    {


        $access = Access::create([
            'date_end' => $date_end,
            'user_id' => $this->id,
        ]);
        $this->date_end = $date_end;
        $this->date_start = $access->created_at;
        $this->save();
    }

    public function getAccess()
    {
        if ($this->isAdmin()) {
            return true;
        } else {

            $access = Access::where('user_id', $this->id)->where('date_end', '>=', date('Y-m-d'))->orderBy('updated_at', 'DESC')->first();

            if (!$access && $this->company_id && $this->type != 'chief') {

                $user = User::where('type', 'chief')->where('company_id', $this->company_id)->first();
                if ($user) {
                    $access = Access::where('user_id', $user->id)->where('date_end', '>=', date('Y-m-d'))->orderBy('updated_at', 'DESC')->first();
                }

            }
            return ($access ? true : false);

        }

    }

    public function getAccessEnd()
    {
        if ($this->isAdmin()) {
            return 'Бессрочно';
        } else {

            $access = Access::where('user_id', $this->id)->where('date_end', '>=', date('Y-m-d'))->orderBy('updated_at', 'DESC')->first();

            if (!$access && $this->company_id && $this->type != 'chief') {

                $user = User::where('type', 'chief')->where('company_id', $this->company_id)->first();
                if ($user) {
                    $access = Access::where('user_id', $user->id)->where('date_end', '>=', date('Y-m-d'))->orderBy('updated_at', 'DESC')->first();
                }

            }
            if ($access) {
                return $access->date_end;
            } else {
                return 'Закончился';
            }

        }

    }

    public function getCertificat($user_id = null)
    {
        $user_id = $user_id ?? Auth::id();

        $sales_cer = Certificat::where('section', 'S')->where('user_id', $user_id)->get();

        return $sales_cer;
    }

    public function getCertificatCount($user_id = null)
    {
        $user_id = $user_id ?? $this->id;

        $sales_cer = Certificat::where('user_id', $user_id)->count();

        return $sales_cer;
    }

    public function isChief()
    {
        return ($this->type == 'chief' ? true : false);
    }

    public function getTeam()
    {
        if ($this->company_id > 0) {

            $team = User::where('company_id', $this->company_id)->where('active', true)->where('id', '!=', $this->id)->get();
            return $team;
        } else {
            return [];
        }
    }

    public
    function getTeamDel()
    {
        $team = User::where('company_id', $this->company_id)->where('active', false)->where('id', '!=', $this->id)->get();
        return $team;
    }

    public
    function getCountTeam()
    {
        $team_count = User::where('company_id', $this->company_id)->where('active', true)->count();
        return $team_count;
    }

    public function addTeammate($data)
    {
        if ($teammate = User::where('email', $data['email'])->first()) {
            return [false, 'Данный пользователь уже существует в нашей базе!'];
        } else {

            if ($this->getCountTeam() < $this->company_limit) {
                $password = $this->randomPassword();

                $data['company_id'] = $this->company_id;
                $data['type'] = 'user';
                $data['password'] = Hash::make($password);

                $user = User::create($data);

                $user->company_id = $this->company_id;

                $user->save();

                $file_path = '/images/user/' . $user->id . '/';
                if (!file_exists(public_path() . $file_path)) {
                    mkdir(public_path() . $file_path, 0777, true);
                }

                Mail::send('emails.register', ['password' => $password, 'user' => $user], function ($m) use ($user) {
                    $email = config('mail.from.address');
                    $m->from($email, 'Karadau');
                    $m->to($user->email, $user->first_name . ' ' . $user->last_name)->subject('Регистрация на сайте "" ');
                });

                Mail::send('emails.register_user', ['user' => $user], function ($m) use ($user) {
                    $email = config('mail.from.address');
                    $m->from($email, 'Karada');
                    //                $m->to('karada.help@mail.ru', 'Karadau')->subject('Регистрация на сайте "" ');
                    $m->to('vladimir.aiki@gmail.com', 'Karadau')->subject('Регистрация на сайте "" ');
                });

                return [true, 'ok'];
            } else {
                return [false, 'Команда переполнена'];
            }
        }

    }

    public function deleteTeammate($id)
    {
        $user = User::where('company_id', $this->company_id)
            ->where('id', $id)
            ->first();

        if ($user) {
            $user->delete();

            return [true, 'ok'];
        } else {
            return [false, 'not found'];
        }

    }

    public function randomPassword()
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

    public function incTime($course_id = 1)
    {
        $user_id = $this->id;

        $resource = new RedisData('karada');
        $key = "user_{$user_id}";
        return $resource->incKey($key, 'time');
    }

    public function getTime()
    {
        $user_id = $this->id;

        $resource = new RedisData('karada');
        $key = "user_{$user_id}";
        $time = $resource->getKey($key, 'time');
        $time = $time * 10;
        return $time;
    }

    public function getLasLesson()
    {
        $resource = new RedisData('karada');

        $key_ = "user_{$this->id}:last";
        $last_lesson_url = $resource->getKeyRaw($key_, 'lesson');
        $resource->close();

        return ($last_lesson_url ? $last_lesson_url : '/home/course/1');

    }

}
