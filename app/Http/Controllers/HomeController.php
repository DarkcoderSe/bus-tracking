<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notification;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(auth()->user()->hasRole('admin'))
            return view('home');
        else if(auth()->user()->hasRole('driver')){
            return view('driver.home');
        }
        else{
            $notifications = Notification::all();
            return view('user.home')->with([
                'notifications' => $notifications
            ]);
        }
    }
}
