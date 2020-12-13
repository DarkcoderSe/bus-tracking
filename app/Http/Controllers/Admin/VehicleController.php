<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// including models to controllers.
use App\User;
use App\Vehicle;

use Toastr;

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
		$drivers = User::whereRoleIs('driver')->get(); // getting all drivers list to send to view.
		$vehicle = Vehicle::find($id); // getting the speific vehicle to edit
		return view('admin.vehicle.edit')->with([
			'vehicle' => $vehicle, // sending vehicle record to edit view.
			'drivers' => $drivers
		]);
    }

    // shows the deleting method of vehicle.
    public function delete($id){
		try {
			Vehicle::destroy($id); // checks the if vehicle is deletable or not.
		} catch (\Throwable $th) {
            abort(404); // if argu is wrong then 404 page.
		}

		// Toastr is notification package we are using for project.
		Toastr::success('Vehicle record deleted successfully', 'Success');
		return redirect()->back(); // redirecting back to list page.
	}
    
    // submitting record to Database.
	public function submit(Request $request){
		// added some validation for form values. 
		$request->validate([
			'registration_no' => 'required|string',
			'driver_id' => 'required|integer',
			'seats' => 'required|integer',
			'route' => 'required|string',
			'description' => 'nullable',
		]);
		// dd($request->all()); // debugging method die dump.
		$vehicle = new Vehicle;
		$vehicle->registration_no = $request->registration_no;
		$vehicle->driver_id = $request->driver_id;
		$vehicle->seats = $request->seats;
		$vehicle->route = $request->route;
		$vehicle->status = $request->status == 'on' ? 1 : 0; // checking if checkbox is checked or not. we are saving 0 and 1 bcz column is in boolean.
		$vehicle->description = $request->description;
		$vehicle->save();
		Toastr::success('Vehicle added successfully', 'Success');
		
        return redirect()->back();
	}
    
    // update a specific vehicle in database.
    public function update(Request $request){
		// added some validation for form values. 
		$request->validate([
			'registration_no' => 'required|string',
			'driver_id' => 'required|integer',
			'seats' => 'required|integer',
			'route' => 'required|string',
			'description' => 'nullable',
		]);
		// dd($request->all()); // debugging method die dump.
		try {
			// find that specific vehicle we send the id from view.
			$vehicle = Vehicle::findOrFail($request->id);
			$vehicle->registration_no = $request->registration_no;
			$vehicle->driver_id = $request->driver_id;
			$vehicle->seats = $request->seats;
			$vehicle->route = $request->route;
			$vehicle->status = $request->status == 'on' ? 1 : 0; // checking if checkbox is checked or not. we are saving 0 and 1 bcz column is in boolean.
			$vehicle->description = $request->description;
			$vehicle->save();
		} catch (\Throwable $th) {
			//throw $th;
			Toastr::error('500: Server side error', 'Error');
		}
		Toastr::success('Vehicle added successfully', 'Success');
		return redirect()->back();
	}

	public function location($id){
		$vehicle = Vehicle::find($id);
		return view('admin.vehicle.location')->with([
			'vehicle' => $vehicle
		]);
	}

}
