<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PersonalGoal extends Model
{
    protected $guarded = [];

    public function getStatus()
    {
        if($this->status){
            return 'complete';
        }else{
            if(strtotime($this->date_end) <= time()){
                return 'failed';
            }else{
                return 'in_process';
            }
        }
    }
}
