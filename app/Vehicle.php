<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    // created relation b/w vehicle and driver. one driver belongs to one vehicle at a time.
    public function Driver(){
        return $this->belongsTo(User::class, 'driver_id');
    }
    
}
