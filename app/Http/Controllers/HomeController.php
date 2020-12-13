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
        $notifications = Notification::all();

        if(auth()->user()->hasRole('admin'))
            return view('home');
        else if(auth()->user()->hasRole('driver')){
            return view('driver.home')->with([
                'notifications' => $notifications
            ]);
        }
        else{
            return view('user.home')->with([
                'notifications' => $notifications
            ]);
        }
    }

    public function updateLocation(Request $request){
        $driver = auth()->user();
        $vehicle = $driver->Vehicle;
        $vehicle->latitude = $request->lat;
        $vehicle->longitude = $request->lon;
        $vehicle->save();

        return response()->json('updated', 200);
    }
}
