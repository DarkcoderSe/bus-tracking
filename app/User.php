<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laratrust\Traits\LaratrustUserTrait;

class User extends Authenticatable
{
    use LaratrustUserTrait;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // creating driver relation with driver info table.
    public function DriverInfo(){
        return $this->hasOne(DriverInfo::class, 'driver_id');
    }

    //creating driver relation with vehicle.
    public function Vehicle(){
        return $this->hasOne(Vehicle::class, 'driver_id');
    }

    // creating one to one relation with vehicle and students, faculty.
    public function UserVehicle(){
        return $this->hasOne(UserVehicle::class);
    }

    public function Expenses(){
        return $this->hasMany(Expense::class, 'driver_id');
    }
}
