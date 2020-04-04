<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendMail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:mail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {


//        config(['mail.from.address' => 'help@karada.kz']);
//        config(['mail.username' => 'help@karada.kz']);
//        config(['mail.password' => 'swljcnevvbnbxlth']);

        $email = config('mail.username');

        var_dump($email);

        Mail::send('emails.test', [], function ($m) use ($email) {
//            $email = config('mail.from.address');
            $m->from($email, 'KARADA Школа Продаж');
//            $m->from('aspirin_1988@mail.ru', 'Sergey');

//            $m->to('info@karada.kz', 'Karadau')->subject('Запрос на регистрацию');
//            $m->to('alexandr.karada@gmail.com', 'Karadau')->subject('Запрос на регистрацию');
//            $m->to('vladimir.aiki@gmail.com', 'Karadau')->subject('Запрос на регистрацию');
            $m->to('aspirin_1988@mail.ru', 'Karadau')->subject('Запрос на регистрацию');
//            $m->to('aspirins24@gmail.com', 'Karadau')->subject('Запрос на регистрацию');
        });

    }
}
