<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserAttendence extends Model
{
    public function Attendence(){
        return $this->hasMany(Attendence::class, 'user_attendences_id');
    }
    //
}
