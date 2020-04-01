<?php

namespace App\Http\Controllers;

use App\ArbitraryFields;
use App\Mail\DemoEmail;
use App\Page;
use App\PromoCode;
use App\RedisData;
use App\Video;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SiteController extends Controller
{
    public function index()
    {
//        return redirect()->to('http://karadau.kz/');

//        if (request()->getHttpHost() !== 'karada.kz') {
//            $page = Page::where('slug', 'index')->first();

        return view('profile.main_index');
//        } else {

//            $slug = 'consulting';
//            $page = Page::where('slug', $slug)->where('status', true)->first();
//            if (!$page) {
//                return abort(404);
//            }
//            $data = ArbitraryFields::where('object_type', 'page')->where('object_id', $page->id)->first();
//            $result = [];
//            if ($data) {
//                $fields = json_decode($data->fields, true);
//                foreach ($fields as $item) {
//                    $result[$item['key']] = $item['value'];
//                }
//            }
//
//            $template_path = "pages." . $slug . '.index';
//
//            return view($template_path, ['fields' => $result, 'test' => 'test']);
//        }

    }

    public function book()
    {
        return view('book');
    }

    public function partnership()
    {
        return view('partnership');
    }

    public function events()
    {
        return view('events');
    }

    public function reviews($method = 'video')
    {
        return view('reviews', ['method' => $method]);
    }

    public function clients()
    {
        return view('clients');
    }

    public function about()
    {
        return view('about');
    }

    public function speaker()
    {
        return view('speaker');
    }

    public function masterClass()
    {
        return view('master_class');
    }

    public function consulting()
    {
        return view('consulting');
    }

    public function workshop()
    {
        return view('workshop');
    }

    public function onlineCourse()
    {
        return view('online_course');
    }

    public function orderForm(Request $request)
    {
        $data = $request->all();

//        Mail::to('aspirins24@gmail.com')->send(new DemoEmail());
        $type = [
            'counseling' => "“КОНСУЛЬТАЦИИ”",
            'project_consulting' => "“ПРОЕКТНЫЙ КОНСАЛТИНГ”",
        ];

        Mail::send('emails.consulting', ['data' => $data, 'type' => $type], function ($m) use ($data, $type) {
            $email = config('mail.from.address');
            $m->from($email, 'Karadau');
            $m->to('info@karada.kz', 'karada.kz')->subject('Заявка на услугу ' . $type[$data['type']]);
        });

        return response()->json(['result' => true]);
    }

    public function getPrice(Request $request)
    {
        $code = $request->input('code');

        $resource = new RedisData('karada');
        $trial = $resource->getKey('trial', 'limit');
        $price = $resource->getKey('trial', 'price');

        $promo_code = PromoCode::where('code', $code)->where('date_end', '>', Carbon::now())->first();
        if ($promo_code) {
            $price = ceil(($price / 100) * (100 - $promo_code->discount));
        }
        $resource->close();
        return response()->json(['price' => $price]);
    }

    public function youRegistered()
    {
        return view('auth.you_registered');
    }

    public function applicationRegistration(Request $request)
    {
        $data = $request->all();

        config(['mail.from.address' => env('MAIL_FROM_ADDRESS_INFO')]);
        config(['mail.username' => env('MAIL_FROM_ADDRESS_INFO')]);
        config(['mail.password' => env('MAIL_PASSWORD_INFO')]);

        Mail::send('emails.register_company', ['user' => $data], function ($m) {
            $email = config('mail.from.address');
            $m->from($email, 'Karada');
//            $m->from('aspirin_1988@mail.ru', 'Sergey');

            $m->to('info@karada.kz', 'Info Karada')->subject('Запрос на регистрацию');
//            $m->to('aspirin_1988@mail.ru', 'Sergey')->subject('Запрос на регистрацию');
        });

        header('/');
        exit;
    }

    public function urlVideo($video_id, $video_size = null, Request $request)
    {
        $refer = $request->server('HTTP_REFERER');

        $refer = explode('://', $refer);
        $refer = end($refer);
        $refer = explode('/', $refer);
        $refer = array_shift($refer);

        if (in_array($refer, ['localhost:8000', '127.0.0.1:8000', 'test.karadau.kz', 'karada.kz'])) {
            $video = Video::where('id', $video_id)->first();
            if ($video) {
                if ($video_size) {
                    $path = explode('/', $video->video);
                    $path[count($path) - 1] = $video_size . '_' . $path[count($path) - 1];
//
                    $video->video = implode('/', $path);

                    return response()->download(public_path($video->video));
                } else {
                    return response()->download(public_path($video->video));
                }
            }
        }
    }

    function file_force_download($file)
    {
        if (file_exists($file)) {
            // сбрасываем буфер вывода PHP, чтобы избежать переполнения памяти выделенной под скрипт
            // если этого не сделать файл будет читаться в память полностью!
            if (ob_get_level()) {
                ob_end_clean();
            }
            // заставляем браузер показать окно сохранения файла
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename=' . basename($file));
            header('Content-Transfer-Encoding: binary');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($file));
            // читаем файл и отправляем его пользователю
            readfile($file);
            exit;
        }
    }

}
