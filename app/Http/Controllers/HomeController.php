<?php

namespace App\Http\Controllers;

use App\Certificat;
use App\Course;
use App\CourseBonus;
use App\Diploma;
use App\ExecutiveSection;
use App\Lesson;
use App\Motivation;
use App\News;
use App\PersonalGoal;
use App\SalesPlan;
use App\Section;
use App\Test;
use App\User;
use App\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use App\RedisData;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('active');
        $this->middleware('auth');
        $this->middleware('is_pay:')->except('index');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();

        $personal_goals_in_process = PersonalGoal::where('user_id', $user->id)->where('status', '0')->where('date_end', '>=', date('Y-m-d'))->count();
        $personal_goals_complete = PersonalGoal::where('user_id', $user->id)->where('status', '1')->count();
        $personal_goals_failed = PersonalGoal::where('user_id', $user->id)->where('status', '0')->where('date_end', '<', date('Y-m-d'))->count();

        $personal_goals = PersonalGoal::where('user_id', $user->id)->inRandomOrder()->get();

        $sales = Course::where('id', 1)->first();
//        $marketing = Course::where('id', 2)->first();

        $sales_cer_count = count($sales->getParentSection());
        $sales_section = $sales->getParentSection();
        $sales_cer = Certificat::where('section', 'like', 'S-%')->where('user_id', $user->id)->get();

        if ($news = News::orderBy('created_at', 'DESC')->limit(15)->get()) {
            foreach ($news as $key => $news_) {
                if ($news_->type == 'doc') {
                    $doc = $news_->getDoc();
                    if ($doc) {
                        $news[$key]->doc = $doc;
                        $news[$key]->thumb = '/images/download.png';
                    } else {
                        unset($news[$key]);
                    }
                } else {
                    $video = $news_->getVideo();
                    if ($video) {
                        $news[$key]->video = $video->video;
                        $news[$key]->thumb = $video->thumb;
                    } else {
                        unset($news[$key]);
                    }
                }
            }
        }

        $user_id = Auth::id();
        $key = ":user_{$user_id}:see:news:*";
        $key_motivation = ":user_{$user_id}:see:motivation:*";


        $resource = new RedisData('karada');


        $count_news = News::count();
        $see_news = $resource->getAllKey($key);
        $new_news = $count_news - count($see_news);
        if ($new_news < 0) {
            $new_news = 0;
        }
        $last_lesson_url = Auth::user()->getLasLesson();

        $day = $user->getDay();

        $count_motivation = Motivation::where('day', '<=', $day)->count();
        $see_count_motivation = $resource->getAllKey($key_motivation);
        $count_motivation = $count_motivation - count($see_count_motivation);
        if ($new_news < 0) {
            $new_news = 0;
        }
        if ($motivation = Motivation::where('day', $day)->first()) {
            $video = $motivation->getVideo();
            if ($video) {
                $motivation->video = $video->video;
                $motivation->thumb = $video->thumb;
            }
        } else {
            $motivation = Motivation::orderBy('day', 'desc')->first();
            $video = $motivation->getVideo();
            if ($video) {
                $motivation->video = $video->video;
                $motivation->thumb = $video->thumb;
            }
        }


        if (count($personal_goals) < 3) {
            for ($i = 0; $i < 3 - count($personal_goals); $i++) {
                $personal_goal = new PersonalGoal();
                $personal_goal->image = '/img/empty.png';

                $personal_goals[] = $personal_goal;
            }
        }
        $resource->close();
        $data = [
            'sales_cer' => $sales_cer,
            'sales_cer_count' => $sales_cer_count,
            'sales' => $sales,
            'title' => 'Личный кабинет',
//            'marketing' => $marketing,
            'motivation' => $motivation,
            'background' => $user->getBackground(),
            'ava' => $user->getAva(),
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'email' => $user->email,
            'phone' => $user->phone,
            'city' => $user->city,
            'job' => $user->job,
            'user_stat' => $user->getUserStat(),
            'plan' => $user->getPlan(),
            'personal_goals_in_process' => $personal_goals_in_process,
            'personal_goals_complete' => $personal_goals_complete,
            'personal_goals_failed' => $personal_goals_failed,
            'personal_goals' => $personal_goals,
            'news' => $news,
            'user' => $user,
            'new_news' => $new_news,
            'last_lesson_url' => $last_lesson_url,
            'sales_plan_sum' => $user->getPlansSum(),
            'sales_fact_sum' => $user->getFactSum(),
            'count_motivation' => $count_motivation,
        ];

        return view('profile.index', $data);
    }

    public function edit()
    {
        $user = Auth::user();

        $data = [
            'back_url' => '/home/',
            'title' => 'Редактирование профиля',
            'background' => $user->getBackground(),
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'email' => $user->email,
            'phone' => $user->phone,
            'city' => $user->city,
            'job' => $user->job,
        ];

        return view('profile.edit', $data);
    }

    public function motivation()
    {
        $user = Auth::user();
        $day = ceil((time() - $user->created_at->timestamp) / (60 * 60 * 24));
        $motivations = Motivation::where('day', '<=', $day)->orderBy('day', 'DESC')->paginate(9);
        foreach ($motivations as $key => $motivation) {

            $video = $motivation->getVideo();
            if ($video) {
                $motivations[$key]->video = $video->video;
                $motivations[$key]->thumb = $video->thumb;
            }
        }

        $data = [
            'back_url' => '/home/',
            'title' => 'Мотивация',
            'motivations' => $motivations,
            'background' => $user->getBackground(),
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'email' => $user->email,
            'phone' => $user->phone,
            'city' => $user->city,
            'job' => $user->job,
        ];

        return view('profile.motivation', $data);
    }

    public function news()
    {
        $user = Auth::user();

        $news = News::orderBy('created_at', 'DESC')->paginate(9);
        foreach ($news as $key => $news_) {

            $video = $news_->getVideo();
            if ($video) {
                $news[$key]->video = $video->video;
                $news[$key]->thumb = $video->thumb;
            }
        }

        $data = [
            'back_url' => '/home/',
            'title' => 'Новости',
            'background' => $user->getBackground(),
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'email' => $user->email,
            'phone' => $user->phone,
            'city' => $user->city,
            'job' => $user->job,
            'news' => $news,
        ];

        return view('profile.news', $data);
    }

    public function newsChief()
    {
        $user = Auth::user();

        $news = ExecutiveSection::orderBy('created_at', 'DESC')->get();
        foreach ($news as $key => $news_) {

            $video = $news_->getVideo();
            if ($video) {
                $news[$key]->video = $video->video;
                $news[$key]->thumb = $video->thumb;
            }
        }

        $data = [
            'back_url' => '/home/',
            'background' => $user->getBackground(),
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'email' => $user->email,
            'phone' => $user->phone,
            'city' => $user->city,
            'job' => $user->job,
            'news' => $news,
        ];

        return view('profile.news', $data);
    }

    public function rewards($user_id = null)
    {
        $result = range(0, 10);

        if ($user_id) {
            $user = User::where('id', $user_id)->first();
        } else {
            $user = Auth::user();
        }

        $sales = Course::where('id', 1)->first();

        $sales_cer_count = count($sales->getParentSection());
        $sales_section = $sales->getParentSection();
        $sales_cers = Certificat::where('user_id', $user->id)->get();

        foreach ($sales_cers as $sales_cer) {
            $result[$sales_cer->section_id - 1] = $sales_cer;
        }

        $sales_diploma = Diploma::where('section', 'like', 'SD-%')->where('user_id', $user->id)->first();

        $data = [
            'sales_cer' => $result,
            'sales_cer_count' => $sales_cer_count,
            'back_url' => ($user_id ? '/home/my-team' : '/home/'),
            'sales_section' => $sales_section,
            'background' => $user->getBackground(),
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'email' => $user->email,
            'phone' => $user->phone,
            'city' => $user->city,
            'job' => $user->job,
            'user' => Auth::user(),
            'title' => "мои награды",
            'sales_diploma' => $sales_diploma,
        ];

        return view('profile.rewards', $data);
    }

    public function help()
    {
        $user = Auth::user();

        $data = [
            'back_url' => '/home/',
            'title' => 'Помощь',
            'background' => $user->getBackground(),
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'email' => $user->email,
            'phone' => $user->phone,
            'city' => $user->city,
            'job' => $user->job,
        ];

        return view('profile.help', $data);
    }

    public function myTeam()
    {
        $user = Auth::user();
        $marketing = Course::where('id', 1)->first();

        $sales = Course::where('id', 1)->first();
        $marketing_cer_count = count($marketing->getParentSection());
        $marketing_section = $marketing->getParentSection();
        $marketing_cer = Certificat::where('section', 'like', 'S-%')->where('user_id', $user->id)->get();

        $data = [
            'marketing_cer' => $marketing_cer,
            'marketing_cer_count' => $marketing_cer_count,
            'marketing_section' => $marketing_section,
            'marketing' => $marketing,
            'title' => 'МОЯ КОМАНДА',
            'back_url' => '/home/',
            'background' => $user->getBackground(),
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'email' => $user->email,
            'phone' => $user->phone,
            'city' => $user->city,
            'job' => $user->job,
            'user' => $user,
            'sales' => $sales,
        ];

        return view('profile.my_team', $data);
    }

    public function myTeamSingle($id)
    {
        $user_ = Auth::user();
        $user = User::where('company_id', $user_->company_id)->where('id', $id)->first();

        if ($user) {

            $data = [
                'back_url' => '/home/my-team/',
                'title' => 'ПЛАН ПРОДАЖ ( ' . $user->first_name . ' ' . $user->last_name . ' )',
                'background' => $user->getBackground(),
                'first_name' => $user->first_name,
                'last_name' => $user->last_name,
                'email' => $user->email,
                'phone' => $user->phone,
                'city' => $user->city,
                'job' => $user->job,
                'user_id' => $user->id,
                'sales_plan' => $user->getPlans(),
                'sales_plan_sum' => $user->getPlansSum(),
                'sales_fact_sum' => $user->getFactSum(),
            ];


            return view('profile.plan_teammate', $data);
        } else {
            return abort(404);
        }
    }

    public function myTeamPlan($id)
    {
        $user = User::where('id', $id)->first();

        $plan = $user->getPlansByQuarter();
        $plan_to_years = $user->getPlansSum();
        return response()->json(['list' => $plan, 'plan_to_years' => $plan_to_years]);

    }

    public function addTeammate(Request $request)
    {
        $data = $request->all();

        $user = Auth::user();

        list($result, $message) = $user->addTeammate($data);

        return response()->json(['result' => $result, 'message' => $message]);
    }

    public function removeTeammate($id, Request $request)
    {

        $user = Auth::user();

        list($result, $message) = $user->deleteTeammate($id);

        return response()->json(['result' => $result, 'message' => $message]);
    }

    public function personalGoalsGet($id)
    {
        $personal_goals = PersonalGoal::where('id', $id)->first();

        return response()->json($personal_goals);
    }

    public function personalGoalsUpdate($id, Request $request)
    {
        $data = $request->all();
        unset($data['id']);
        unset($data['file']);
        $files = $request->file('file');

        $result = false;
        $file = $files[0];

        if ($file) {

            $name = md5($file->getClientOriginalName()) . '.' . $file->extension();

            $file_path = '/images/user/' . Auth::id() . '/';

            if (!file_exists(public_path() . $file_path)) {
                mkdir(public_path() . $file_path, 0777, true);
            }

            $result = Storage::put($file_path . $name, file_get_contents($file->getRealPath()));
            $data['image'] = $file_path . $name;
        }


        $personal_goals = PersonalGoal::where('id', $id)->update($data);

        return response()->json(['result' => $personal_goals]);
    }

    public function personalGoals($method = 'in-process')
    {
        $user = Auth::user();

        $personal_goals_in_process = [];
        $personal_goals_complete = [];
        $personal_goals_failed = [];

        $personal_goals_in_process_count = PersonalGoal::where('user_id', $user->id)->where('status', '0')->where('date_end', '>=', date('Y-m-d'))->count();
        $personal_goals_complete_count = PersonalGoal::where('user_id', $user->id)->where('status', '1')->count();
        $personal_goals_failed_count = PersonalGoal::where('user_id', $user->id)->where('status', '0')->where('date_end', '<', date('Y-m-d'))->count();

        switch ($method) {
            case 'in-process':
                $personal_goals_in_process = PersonalGoal::where('user_id', $user->id)->where('status', '0')->where('date_end', '>=', date('Y-m-d'))->paginate(6);
                break;
            case 'complete':
                $personal_goals_complete = PersonalGoal::where('user_id', $user->id)->where('status', '1')->paginate(6);
                break;
            case 'failed':
                $personal_goals_failed = PersonalGoal::where('user_id', $user->id)->where('status', '0')->where('date_end', '<', date('Y-m-d'))->paginate(6);
                break;

        }

//        $personal_goals_in_process = PersonalGoal::where('user_id', $user->id)->where('status', '0')->where('date_end', '>=', date('Y-m-d'))->get();
//        $personal_goals_complete = PersonalGoal::where('user_id', $user->id)->where('status', '1')->get();
//        $personal_goals_failed = PersonalGoal::where('user_id', $user->id)->where('status', '0')->where('date_end', '<', date('Y-m-d'))->get();

        $resource = new RedisData('karada');
        $video_id = $resource->getKey('trial', 'video');
        $video_title = $resource->getKeyRaw('trial', 'video_title');
        $video = Video::where('id', $video_id)->first();

//        $personal_goals = PersonalGoal::where('user_id', $user->id)->get();
        $resource->close();
        $data = [
            'back_url' => '/home/',
            'title' => 'мои личные цели',
            'background' => $user->getBackground(),
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'email' => $user->email,
            'phone' => $user->phone,
            'city' => $user->city,
            'job' => $user->job,
            'personal_goals_in_process' => $personal_goals_in_process,
            'personal_goals_complete' => $personal_goals_complete,
            'personal_goals_failed' => $personal_goals_failed,
            'personal_goals_in_process_count' => $personal_goals_in_process_count,
            'personal_goals_complete_count' => $personal_goals_complete_count,
            'personal_goals_failed_count' => $personal_goals_failed_count,
            'video' => $video,
            'video_title' => $video_title,
            'method' => $method,
        ];

        return view('profile.personal_goals', $data);
    }

    public function personalGoalsApprove($id)
    {
        $goal = PersonalGoal::where('id', $id)->first();

        if ($goal) {
            $goal->status = true;
            $goal->save();

            return response()->json(['result' => true]);
        }

        return response()->json(['result' => false]);

    }

    public function personalGoalsAdd(Request $request)
    {
        $files = $request->file('file');

        $result = false;
        $file = $files[0];


        $name = md5($file->getClientOriginalName()) . '.' . $file->extension();

        $file_path = '/images/user/' . Auth::id() . '/';

        if (!file_exists(public_path() . $file_path)) {
            mkdir(public_path() . $file_path, 0777, true);
        }

        $input = [
            'user_id' => Auth::id(),
            'image' => $file_path . $name,
            'description' => $request->input('description'),
            'status' => false,
            'date_end' => $request->input('date_end'),
        ];

        $result = Storage::put($file_path . $name, file_get_contents($file->getRealPath()));
        if ($result) {
            $user = Auth::user();
            $goals = PersonalGoal::create($input);
        }
        return response()->json(['result' => $result]);
    }

    public function plan()
    {
        $user = Auth::user();

        $data = [
            'back_url' => '/home/',
            'title' => 'МОЙ ПЛАН ПРОДАЖ',
            'user' => $user,
            'background' => $user->getBackground(),
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'email' => $user->email,
            'phone' => $user->phone,
            'city' => $user->city,
            'job' => $user->job,
            'user_id' => $user->id,
            'sales_plan' => $user->getPlans(),
            'sales_plan_sum' => $user->getPlansSum(),
            'sales_fact_sum' => $user->getFactSum(),
        ];


        return view('profile.plan', $data);
    }

    public function getPlanList($id)
    {
        $user = User::where('id', $id)->first();
        $plan = $user->getPlans();

        return response()->json($plan);
    }

    public function planSave($id, Request $request)
    {
        $fact = $request->input('fact', 0);

        $plan = SalesPlan::where('id', $id)->first();
        $plan->fact = $fact;
        $plan->save();

        $user = User::where('id', $plan->user_id)->first();

        $plans = $user->getPlans();

        return response()->json($plans);
    }

    public function getUserPlan($id, Request $request)
    {

        $user = User::where('id', $id)->first();

        $plans = $user->getPlansSum();

        return response()->json($plans);
    }

    public function planUpdate($id, Request $request)
    {
        $plan_to_years = (int)$request->input('plan_to_years', 0);

        $user = User::where('id', $id)->first();

        $plan_to_month_ = ceil($plan_to_years % 12);
        $plan_to_month = ceil(($plan_to_years - $plan_to_month_) / 12);
        if ($plan_to_years && $user) {

            $plans = $user->getPlans();

            foreach ($plans as $key => $plan) {
                if ($key == 11) {
                    $plan->plan = $plan_to_month + $plan_to_month_;
                } else {
                    $plan->plan = $plan_to_month;
                }
                $plan->save();
            }

            return response()->json(['result' => true]);

        }
    }

    public function planCreate(Request $request)
    {
        $auth = Auth::user();

        $user_id = (int)$request->input('user_id', Auth::id());
        $plan_to_years = (int)$request->input('plan_to_years', 0);

        $user = User::where('id', $user_id)->first();

        if ($plan_to_years && $user) {

//            $user = Auth::user();

            $plan = $user->getPlans();

            if ($plan && count($plan)) {
                return response()->json($plan);
            } else {

                $plan_to_month_ = ceil($plan_to_years % 12);
                $plan_to_month = ceil(($plan_to_years - $plan_to_month_) / 12);
                $month = (int)date('m');
                $year = (int)date('Y');

                for ($i = 0; $i < 12; $i++) {

                    if ($month > 12) {
                        $year++;
                        $month = 1;
                    }
                    if ($i == 11) {
                        $plan_to_month = $plan_to_month + $plan_to_month_;
                    }

                    SalesPlan::create([
                        'user_id' => $user->id,
                        'month' => $month,
                        'year' => $year,
                        'plan' => $plan_to_month,
                        'fact' => 0,
                    ]);
                    $month++;
                }

            }
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false, 'message' => 'План не может быть равен нулю']);
        }
    }

    public function course()
    {
        return response()->redirectTo('/home/course/1');
//        return view('profile.courses');
    }

    public function courseSingle($id)
    {
        $course = Course::where('id', $id)->first();


        return view('profile.course_single', [
            'back_url' => '/home/',
            'title' => 'Курс "Альфа Продавец"',
            'course' => $course,
        ]);
    }

    public function couseIntro($id)
    {
        $course = Course::where('id', $id)->first();


        return view('profile.course_intro', [
            'back_url' => '/home/',
            'title' => 'Курс "Альфа Продавец"',
            'course' => $course,
        ]);
    }

    public function cousePDF($id)
    {
        $course = Course::where('id', $id)->first();


        return view('profile.course_pdf', [
            'back_url' => '/home/',
            'course' => $course,
        ]);
    }

    public function sectionSingle($course_id, $section_id)
    {
        $sub_section = null;
        $course = Course::where('id', $course_id)->first();
        $section = Section::where('id', $section_id)->where('course_id', $course_id)->first();
        $sub_section_id = null;
        if ($section->parent_id) {
            $section_id = $section->parent_id;
            $sub_section_id = $section->id;
        }
//        if ($sub_section_id) {
//            $sub_section = Section::where('id', $sub_section_id)->where('course_id', $course_id)->first();
//        }

//        $user_id = Auth::id();
//        $resource = new RedisData('karada');
//        $key = "user_{$user_id}:stat:section";
//        $resource->setKey(1, $key, $section_id);

        return view('profile.section_single', [
            'back_url' => $course->getUrl(),
            'course' => $course,
            'title' => 'Курс "Альфа Продавец"',
            'section' => ($sub_section ? $sub_section : $section),
            'section_id' => $section_id,
            'sub_section_id' => $sub_section_id,
        ]);
    }

    public function testSingle($id, $section_id, $lesson_id, $test_id)
    {
        $test = Test::where('id', $test_id)->first();
        $lesson = Lesson::where('id', $lesson_id)->first();
        $next_lesson = $lesson->getNext();

        return view('profile.test_single', [
            'test' => $test,
            'title' => 'Курс "Альфа Продавец"',
            'lesson' => $lesson,
            'course_id' => $id,
            'next_lesson' => $next_lesson,
            'section_id' => $section_id,
        ]);
    }

    public function lessonSingleSetStat($lesson_id)
    {
        $resource = new RedisData('karada');
        $user_id = Auth::id();
        $key = "user_{$user_id}:stat:lesson";
        $result = $resource->setKey(1, $key, $lesson_id);
        $resource->close();
        return response()->json(['result' => $result]);
    }

    public function lessonSingle($course_id, $section_id, $lesson_id)
    {
        $resource = new RedisData('karada');

        $user_id = Auth::id();

        $key = "user_{$user_id}:stat:lesson";
        $key_ = "user_{$user_id}:last";


        $lesson = Lesson::where('id', $lesson_id)->first();
        $resource->setKey($lesson->getUrl(), $key_, 'lesson');

        $course = Course::where('id', $course_id)->first();
        $section = Section::where('id', $section_id)->where('course_id', $course_id)->first();
        $sub_section_id = null;
        if ($section->parent_id) {
            $section_id = $section->parent_id;
            $sub_section_id = $section->id;
        }

//        dd($section_id,$sub_section_id);
        $resource->close();
        return view('profile.lesson_single', [
            'back_url' => $section->getUrl(),
            'lesson' => $lesson,
            'title' => 'Курс "Альфа Продавец"',
            'course' => $course,
            'section' => $section,
            'section_id' => $section_id,
            'sub_section_id' => $sub_section_id,
        ]);
    }

    public function video()
    {
        return view('course.video');
    }

    public function partnership()
    {
        return view('home_partnership');
    }

    public function lifeHack()
    {
        return view('course.life_hack');
    }

    public function test()
    {
        return view('course.test');
    }

    public function testRun()
    {
        return view('course.test_start');
    }

    public function testResult()
    {
        return view('course.test_result');
    }

    public function uploadAva(Request $request)
    {

        $files = $request->file('file');

        $result = false;
        $file = $files[0];

        $name = 'ava.' . $file->extension();
        $mimetype = $file->getClientMimeType();
        $mimetype_ = explode('/', $mimetype);
        $mimetype_ = array_shift($mimetype_);

        if (strtolower($mimetype_) == 'image') {

            $file_path = '/images/user/' . Auth::id() . '/';

            if (!file_exists(public_path() . $file_path)) {
                mkdir(public_path() . $file_path, 0777, true);
            }

            $result = Storage::put($file_path . $name, file_get_contents($file->getRealPath()));
            if ($result) {
                $user = Auth::user();
                $user->ava = $file_path . $name;
                $user->save();
            }
            return response()->json(['result' => $result, 'mimetype' => $mimetype]);
        } else {
            return response()->json(['result' => false, 'mimetype' => $mimetype, 'message' => 'Данный тип файла запрещен для загрузки!']);
        }
    }

    public function uploadBackground(Request $request)
    {
        $files = $request->file('file');

        $result = false;
        $file = $files[0];

        $name = 'background.' . $file->extension();
        $mimetype = $file->getClientMimeType();
        $mimetype_ = explode('/', $mimetype);
        $mimetype_ = array_shift($mimetype_);

        if (strtolower($mimetype_) == 'image') {

            $file_path = '/images/user/' . Auth::id() . '/';

            if (!file_exists(public_path() . $file_path)) {
                mkdir(public_path() . $file_path, 0777, true);
            }

            $result = Storage::put($file_path . $name, file_get_contents($file->getRealPath()));

            if ($result) {
                $user = Auth::user();
                $user->background = $file_path . $name;
                $user->save();
            }

            return response()->json(['result' => $result, 'mimetype' => $mimetype]);
        } else {
            return response()->json(['result' => false, 'mimetype' => $mimetype, 'message' => 'Данный тип файла запрещен для загрузки!']);
        }
    }

    public function password()
    {
        $user = Auth::user();
        return view('profile.password_update', [
            'title' => 'Смена пароля',
            'back_url' => '/home/',
            'background' => $user->getBackground(),
            'id' => $user->id,
        ]);
    }

    public function updatePassword(Request $request)
    {
        $password_old = $request->input('password');
        $password_new = $request->input('password_new');
        $password_new_c = $request->input('password_new_c');

        $user = Auth::user();


        if (Hash::check($password_old, $user->password)) {
            $user->password = Hash::make($password_new);
            $user->save();

            Mail::send('emails.password_update', ['password' => $password_new, 'user' => $user], function ($m) use ($user) {
                $email = config('mail.from.address');
                $m->from($email, 'Karadau');
                $m->to($user->email, $user->first_name . ' ' . $user->last_name)->subject('Смена пароля');
            });

            Auth::logout();


            return response()->json(['result' => true]);
        }
        return response()->json(['result' => false]);

    }

    public function incTime(Request $request)
    {
        $id = $request->input('user_id');

        $course_id = $request->input('course_id');

        $user = Auth::user();

        $get_time = Cache::remember('inc_' . $user->id, 10, function () use ($course_id, $user) {
            return $user->incTime($course_id);
        });


        return response()->json($get_time);


    }

    public function courseBonus()
    {
        $course_bonus = CourseBonus::orderBy('created_at', 'DESC')->paginate(9);

        $user = Auth::user();

        $data = [
            'back_url' => '/home/',
            'title' => 'Бонусные материалы',
            'background' => $user->getBackground(),
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'email' => $user->email,
            'phone' => $user->phone,
            'city' => $user->city,
            'job' => $user->job,
            'news' => $course_bonus,
        ];

        return view('profile.course_bonus', $data);
    }

    public function see(Request $request)
    {
        $user_id = Auth::id();

        $resource = new RedisData('karada');
        $key = "user_{$user_id}:see";
        $id = $request->input('key');
        $result = $resource->setKey(true, $key, $id);
        $resource->close();
        return response()->json($result);
    }

    public function updatePlan(Request $request)
    {
        $user_id = $request->input('id');
        $year = $request->input('year');
        $quarter = $request->input('quarter');
        $plan = $request->input('plan');

        $user = User::where('id', $user_id)->first();

        $plan = $user->updatePlansByQuarter($year, $quarter, $plan);


        return response()->json($plan);
    }

    public function updateUser($id)
    {
        $user = User::where('id', $id)->first();
        Mail::send('emails.edit', ['user' => $user], function ($m) use ($user) {
            $email = config('mail.from.address');
            $m->from($email, 'Karada');
//            $m->to('karada.help@mail.ru', 'Karadau')->subject('Изменение личных данных');
            $m->to('vladimir.aiki@gmail.com', 'Karadau')->subject('Изменение личных данных');
        });
    }

}


