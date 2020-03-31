<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $guarded = [];

    public function getVideoSize(int $size = null)
    {
        if ($size) {
            return '/blob/' . $this->id . '/' . $size;
        } else {
            return '/blob/' . $this->id;
        }
    }

}
