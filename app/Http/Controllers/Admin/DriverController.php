<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Role;
use App\User;
use App\Vehicle; // adding vehicle model to driver controlller.

class DriverController extends Controller
{
    // shows the list of all drivers.
    public function index(){
		$drivers = User::whereRoleIs('driver')->get(); // get all drivers here.
		return view('admin.driver.index')->with([ 
			'drivers' => $drivers // sending the list to view.
		]);
    }
    
    // shows the creating a driver page.
	public function create(){
		$drivers = User::whereRoleIs('driver')->get(); // getting only list of drivers.
		return view('admin.driver.create')->with([
			'drivers' => $drivers // sending the of drivers to create driver view.
		]);
    }

    // shows the edit page of driver.
    public function edit($id){
		$drivers = User::whereRoleIs('driver')->get(); // getting all drivers list to send to view.
		$driver = driver::find($id); // getting the speific driver to edit
		return view('admin.driver.edit')->with([
			'driver' => $driver, // sending driver record to edit view.
			'drivers' => $drivers
		]);
    }

    // shows the deleting method of driver.
    public function delete($id){
		try {
			driver::destroy($id); // checks the if driver is deletable or not.
		} catch (\Throwable $th) {
            abort(404); // if argu is wrong then 404 page.
		}

		// Toastr is notification package we are using for project.
		Toastr::success('driver record deleted successfully', 'Success');
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
			'description' => 'required|nullable',
		]);
		// dd($request->all()); // debugging method die dump.
		$driver = new driver;
		$driver->registration_no = $request->registration_no;
		$driver->driver_id = $request->driver_id;
		$driver->seats = $request->seats;
		$driver->route = $request->route;
		$driver->status = $request->status == 'on' ? 1 : 0; // checking if checkbox is checked or not. we are saving 0 and 1 bcz column is in boolean.
		$driver->description = $request->description;
		$driver->save();
		Toastr::success('driver added successfully', 'Success');
		
        return redirect()->back();
	}
    
    // update a specific driver in database.
    public function update(Request $request){
		// added some validation for form values. 
		$request->validate([
			'registration_no' => 'required|string',
			'driver_id' => 'required|integer',
			'seats' => 'required|integer',
			'route' => 'required|string',
			'description' => 'required|nullable',
		]);
		// dd($request->all()); // debugging method die dump.
		try {
			// find that specific driver we send the id from view.
			$driver = driver::findOrFail($request->id);
			$driver->registration_no = $request->registration_no;
			$driver->driver_id = $request->driver_id;
			$driver->seats = $request->seats;
			$driver->route = $request->route;
			$driver->status = $request->status == 'on' ? 1 : 0; // checking if checkbox is checked or not. we are saving 0 and 1 bcz column is in boolean.
			$driver->description = $request->description;
			$driver->save();
		} catch (\Throwable $th) {
			//throw $th;
			Toastr::error('500: Server side error', 'Error');
		}
		Toastr::success('driver added successfully', 'Success');
		return redirect()->back();
	}
}
