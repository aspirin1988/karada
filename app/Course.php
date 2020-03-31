<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Course extends Model
{
    protected $guarded = [];

    public function getParentSection()
    {
        return Section::where('course_id', $this->id)->where('parent_id', 0)->orderBy('sort', 'desc')->get();
    }

    public function getParentSectionCount()
    {
        return Section::where('course_id', $this->id)->where('parent_id', 0)->count();
    }


    public function getLessons()
    {
        $lessons = [];

        $sections = Section::where('course_id', $this->id)->get();

        foreach ($sections as $section) {

            $lessons_ = $section->getLesson();
            foreach ($lessons_ as $item) {
                $lessons[] = $item;
            }
        }
        return $lessons;
    }

    public function getUrl()
    {
        return "/home/course/" . $this->id;
    }

    public function getLessonsCountCheck($user_id = null)
    {
        $lessons = 0;
        $resource = new RedisData('karada');
        $user_id = $user_id ?? Auth::id();
        $sections = Section::where('course_id', $this->id)->get();
        foreach ($sections as $section) {

            $lessons_ = $section->getLesson();
            foreach ($lessons_ as $item) {
                $key = "user_{$user_id}:stat:lesson";
                $key_test = "user_{$user_id}:stat:lesson_" . $item->id . ':test';


                if ($resource->getKey($key, $item->id) && $resource->getKey($key_test, $item->test_id)) {
                    $lessons++;
                }
            }
        }
        $resource->close();
        return $lessons;
    }

    public function progress($user_id = null)
    {
        $user_id = $user_id ?? Auth::id();

        $lessons = $this->getLessons();

        $lessons_check = $this->getLessonsCountCheck($user_id);

        if (count($lessons) && $lessons_check) {
            return ceil(($lessons_check / count($lessons)) * 100);
        } else {
            return 0;
        }
    }

    public function getStat($user_id = null)
    {
        $user_id = $user_id ?? Auth::id();

        $resource = new RedisData('karada');
        $type = "user_{$user_id}";
        $key = "time";
//        dd($resource->getKey($type,$key));

        $time = $resource->getKey($type, $key);


        $time = $time * 10;

        $hours = floor($time / (60 * 60));
        $minutes = floor(($time - $hours * (60 * 60)) / 60);
        $time = $time - $hours * (60 * 60);
        $time = $time - $minutes * 60;
        $sec = round(($time % 60));
        $resource->close();
        return $hours . ' ч : ' . $minutes . ' мин : ' . $sec . ' сек';
    }

    public function getAllPDF()
    {
        $lessons = $this->getLessons();
        $result = [];
        foreach ($lessons as $lesson) {
            $docs = json_decode($lesson->docs, true);
            if ($docs && is_array($docs)) {
                foreach ($docs as $doc) {
                    $result[$doc['id']] = $doc;
                }
            }


        }

        return $result;
    }

    public function getThumbCategory()
    {
        $thumb = Media::where('id', $this->thumb_category)->first();

        if ($thumb) {
            return $thumb->image;
        } else {
            return '/img/empty.png';
        }
    }

    public function getThumbSection()
    {
        $thumb = Media::where('id', $this->thumb_section)->first();

        if ($thumb) {
            return $thumb->image;
        } else {
            return '/img/empty.png';
        }
    }

    public function getVideo()
    {
        return Video::where('id', $this->video)->first();
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

    public function getSectionFinished($user_id = null)
    {
        $user_id = $user_id ?? Auth::id();

        $resource = new RedisData('karada');
        $type = ":user_{$user_id}:stat:section:*";

        $sections = $resource->getAllKey($type);
        $count = 0;
        foreach ($sections as $section) {
            $key = explode('karada:', $section);
            $key = end($key);
            $data = $resource->getKey($key);
            if ($data) {
                $count++;
            }
        }
        $resource->close();
        return $count;

    }

}
