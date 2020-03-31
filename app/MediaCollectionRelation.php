<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MediaCollectionRelation extends Model
{
    protected $guarded=[];

    public function getMedia()
    {
        return Media::where('id',$this->media_id)->first();
    }
}
