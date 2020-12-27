<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserVehicle extends Model
{
    // creating one to one relation with uservehicle and vehicle.
    public function Vehicle(){
        return $this->belongsTo(Vehicle::class);
    }

    public function User(){
        return $this->belongsTo(User::class);
    }
    //
}
