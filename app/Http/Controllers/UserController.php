<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    //

    public function getChallan(){
        return view('user.challan');
    }

    public function registeredUsers(){
        $vehicle = auth()->user()->Vehicle;
        
    }
}
