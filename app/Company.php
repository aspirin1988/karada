<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $guarded = [];

    public function getChief()
    {
        $user = User::where('type', 'chief')->where('company_id', $this->id)->first();
        if($user) {
            $access = Access::where('user_id', $user->id)->where('date_end', '>=', date('Y-m-d'))->orderBy('updated_at', 'DESC')->first();
            if($access) {
                $user->access_start = date('Y-m-d', strtotime($user->date_start));
                $user->access_end = date('Y-m-d', strtotime($user->date_end));
                $user->command_limit = $user->getCountTeam() . '/' . $user->company_limit;
            }
        }
        return $user;
    }

    public function deleteUser()
    {
        User::where('company_id',$this->id)->delete();
    }
}
