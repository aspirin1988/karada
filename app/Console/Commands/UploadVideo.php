<?php

namespace App\Console\Commands;

use App\User;
use App\Video;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class UploadVideo extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'upload:video';

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
        $files = [];

        $files_ = scandir('/home/test/video/');

        foreach ($files_ as $key => $value) {
            if (strpos($value, '.mp4') === false) {
                unset($files[$key]);
            } else {
                $files[$key] = [
                    'name' => $value,
                    'path' => '/home/test/video/' . $value,
                ];
            }
        }

        $dir = 'video';

        foreach ($files as $file) {

            $name = md5($file['name'] . date('Y-m-d H:i:s')) . '.mp4';
            $thumb = md5($file['name'] . date('Y-m-d H:i:s')) . '.jpg';

            $file_path = '/videos/' . $dir . '/' . date('Y-m-d') . '/';

            if (!file_exists(public_path() . $file_path)) {
                mkdir(public_path() . $file_path, 0777, true);
            }

            $command = 'ffmpeg -i ' . $file['path'] . ' -vframes 1 -an -s 1920x1080 -ss 0 ' . public_path($file_path . $thumb);
            exec($command);
            $command = 'ffmpeg -i ' . $file['path'] . ' -s hd720 -c:v libx264 -crf 23 -c:a aac -strict -2 ' . public_path($file_path . '720_' . $name);
            exec($command);
            $command = 'ffmpeg -i ' . $file['path'] . ' -s hd480 -c:v libx264 -crf 23 -c:a aac -strict -2 ' . public_path($file_path . '480_' . $name);
            exec($command);

            $result = Storage::put($file_path . $name, file_get_contents($file['path']));

            $input = [
                'title' => $file['name'],
                'video' => $file_path . $name,
                'thumb' => $file_path . $thumb,
            ];

            $video = Video::create($input);
            if ($video) {
                unlink($file['path']);
            }
        }

    }
}
