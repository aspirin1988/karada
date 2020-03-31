<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TestQuestion extends Model
{
    protected $guarded =[];

    public function PregApi()
    {
        return [
            'id'=>$this->id,
            'question'=>$this->question,
            'answers'=> $this->answers,
            'position'=>$this->position,
            'correct'=>$this->correct,
        ];
    }
}
