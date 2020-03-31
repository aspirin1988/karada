<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CourseBonus extends Model
{
    protected $guarded = [];

    public function getVideo()
    {
        return Video::where('id', $this->video_id)->first();
    }

    public function getThumb()
    {
        $video = $this->getVideo();
        if ($video) {
            return $video->thumb;
        } else {
            return null;
        }
    }

    public function getDoc()
    {
        return Doc::where('id', $this->doc_id)->first();
    }

    public function getDocUlr()
    {
        $doc = $this->getDoc();
        if ($doc) {
            return $doc->url;
        } else {
            return null;
        }
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
}
