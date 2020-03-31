<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Motivation extends Model
{
    protected $guarded = [];

    public function getVideo()
    {
        return Video::where('id', $this->video_id)->first();
    }

    public function getVideoSize(int $size = null)
    {
        $video = $this->getVideo();
        if ($video) {
            if ($size) {
                return '/blob/' . $video->id . '/' . $size;
            } else {
                return '/blob/' . $video->id;
            }
        } else {
            return null;
        }
    }

    public function isSee()
    {
        $user_id = Auth::id();
        $key = "user_{$user_id}:see";
        $id = "motivation:{$this->id}";

        $resource = new RedisData('karada');
        return $resource->getKey($key, $id);


    }

}
