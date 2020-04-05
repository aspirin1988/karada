<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class Lesson extends Model
{
    protected $guarded = [];

    public function getThumb()
    {
        $thumb = Media::where('id', $this->thumb)->first();

        if ($thumb) {
            return $thumb->image;
        } else {
            return '/img/empty.png';
        }
    }

    public function getUrl()
    {
        $section = Section::where('id', $this->section_id)->first();
        $course = Course::where('id', $section->course_id)->first();
//        if($section->parent_id) {
//            $url = "/home/course/{$course->id}/{$section->parent_id}/{$section->id}/" . $this->id;
//        }else{
        $url = "/home/course/{$course->id}/{$section->id}/" . $this->id;
//        }
        return $url;
    }

    public function getSection()
    {
        $section = Section::where('id', $this->section_id)->first();
        return $section;

    }

    public function getSectionId()
    {
//        $section = Section::where('id', $this->section_id)->first();
        return $this->section_id;

    }

    public function getCourse()
    {
        $section = Section::where('id', $this->section_id)->first();
        $course = Course::where('id', $section->course_id)->first();
        return $course;

    }

    public function getCourseId()
    {
        $section = Section::where('id', $this->section_id)->first();
        $course = Course::where('id', $section->course_id)->first();
        return $course->id;

    }

    public function getTest()
    {
        $test = Test::where('id', $this->test_id)->first();

        return $test;
    }

    public function getTestTitle()
    {
        $test = $this->getTest();

        return $test->title;
    }

    public function getTestUrl()
    {
        $url = $this->getUrl();

        return $url . '/' . $this->test_id;
    }

    public function getVideo()
    {
        $videos = json_decode($this->videos, true);
        if ($videos) {

            foreach ($videos as $key => $video) {
                $videos[$key] = new Video($video);
            }

            return $videos;
        } else {
            return [];
        }
    }

    public function getDocs()
    {
        $docs = json_decode($this->docs, true);
        if ($docs) {
            return $docs;
        } else {
            return [];
        }
    }

    public function getComplete()
    {
        $user_id = Auth::id();
        $resource = new RedisData('karada');
        $key = "user_{$user_id}:stat:lesson";
        return $resource->getKey($key, $this->id);
    }

    public function getNext()
    {
        $lessons_list = Cache::remember('lessons_list_cache', now()->addMinutes(10), function () {
            $course = Course::where('id', 1)->first();
            return $course->getLessons();
        });
        $next_ = false;
        foreach ($lessons_list as $key => $item) {
            if ($next_) {
                return $item;
            }
            if ($this->id == $item->id) {
                $next_ = true;
            }
        }
        return null;
    }
}
