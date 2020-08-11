<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// including models to controllers.
use App\User;
use App\Vehicle;

class VehicleController extends Controller
{
    // shows the list of all vehicles.
    public function index(){
		$vehicles = Vehicle::all(); // get all vehicles here.
		return view('admin.vehicle.index')->with([ 
			'vehicles' => $vehicles // sending the list to view.
		]);
    }
    
    // shows the creating a vehicle page.
	public function create(){
		$drivers = User::whereRoleIs('driver')->get(); // getting only list of drivers.
		return view('admin.vehicle.create')->with([
			'drivers' => $drivers // sending the of drivers to create vehicle view.
		]);
    }

    // shows the edit page of vehicle.
    public function edit($id){
		$vehicle = Vehicle::find($id); // getting the speific vehicle to edit
		return view('admin.vehicle.edit')->with([
			'vehicle' => $vehicle // sending vehicle record to edit view.
		]);
    }

    // shows the deleting method of vehicle.
    public function delete($id){
		try {
			Vehicle::destroy($id); // checks the if vehicle is deletable or not.
		} catch (\Throwable $th) {
            abort(404); // if argu is wrong then 404 page.
		}
		return redirect()->back(); // redirecting back to list page.
	}
    
    // submitting record to Database.
	public function submit(Request $request){
        
        return redirect()->back();
	}
    
    // update a specific vehicle in database.
    public function update(Request $request){
		return redirect()->back();
	}

}
