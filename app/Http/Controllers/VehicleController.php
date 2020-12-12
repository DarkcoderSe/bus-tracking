<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Vehicle;

class VehicleController extends Controller
{
    // shows the list of all vehicles.
    public function index(){
		$vehicles = Vehicle::all(); // get all vehicles here.
		return view('user.vehicle.index')->with([ 
			'vehicles' => $vehicles // sending the list to view.
		]);
    }
}
