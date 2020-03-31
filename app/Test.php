<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Test extends Model
{
    protected $guarded = [];

    public function getUrl()
    {
        $url = "/home/test/" . $this->id;
        return $url;
    }

    public function getQuestions()
    {
        return TestQuestion::where('test_id',$this->id)->get();
    }

    public function getComplete($lesson_id = 0)
    {
        $user_id = Auth::id();
        $resource = new RedisData('karada');
        $key = "user_{$user_id}:stat:lesson_" . $lesson_id . ':test';
        $result = $resource->getKey($key, $this->id);
        $resource->close();

        return $result;
    }
}
