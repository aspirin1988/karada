<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Help extends Model
{
    protected $guarded =[];

    public function getVideo()
    {
        return Video::where('id', $this->video)->first();
    }
}
