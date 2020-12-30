<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Role;
use App\User;
use App\Vehicle; // adding vehicle model to driver controlller.
use App\DriverInfo;
use App\Expense;
use Hash;
use DB;
use Toastr;

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
		$vehicles = Vehicle::where('status', 1)->get(); // get the active vehicle list.;
		return view('admin.driver.create')->with([
			'vehicles' => $vehicles
		]);
    }

    // shows the edit page of driver.
    public function edit($id){
		$vehicles = Vehicle::where('status', 1)->get(); // get the active vehicle list.;
		$driver = User::find($id); // getting the speific driver to edit
		return view('admin.driver.edit')->with([
			'driver' => $driver, // sending driver record to edit view.
			'vehicles' => $vehicles
		]);
    }

    // shows the deleting method of driver.
    public function delete($id){
		try {
			
			DriverInfo::where('driver_id', $id)->delete();
			Expense::where('driver_id', $id)->delete();
			Vehicle::where('driver_id', $id)->delete();
			User::destroy($id); // checks the if driver is deletable or not.

		} catch (\Throwable $th) {
			// throw $th;
			Toastr::error('This record is linked with vehicle. Please delete vehicle record first!');
			return redirect()->back();
            // abort(404); // if argu is wrong then 404 page.
		}

		// Toastr is notification package we are using for project.
		Toastr::success('driver record deleted successfully', 'Success');
		return redirect()->back(); // redirecting back to list page.
	}
    
    // submitting record to Database.
	public function submit(Request $request){
		// dd($request->all());
		// added some validation for form values. 
		$request->validate([
			'name' => 'required|string',
			'email' => 'required|string',
			'password' => 'required|string',
			'contact_no' => 'required|string',
			'license_no' => 'required|string',
			'experience' => 'nullable|numeric',
			'pay' => 'required|numeric',
			'address' => 'required|string'
		]);
		
		DB::beginTransaction(); // starting transaction for runtime db error.
		// if one query executed and other gives error then both will be roll backed. 
		try {
			// dd($request->all()); // debugging method die dump.
			$driver = new User;
			$driver->name = $request->name;
			$driver->email = $request->email;
			$driver->password = Hash::make($request->password);
			$driver->contact_no = $request->contact_no;
			$driver->address = $request->address;
			$driver->save();

			$driverInfo = new DriverInfo;
			$driverInfo->status = $request->status == 'on' ? 1 : 0; // checking if checkbox is checked or not. we are saving 0 and 1 bcz column is in boolean.
			$driverInfo->driver_id = $driver->id;
			$driverInfo->license_no = $request->license_no;
			$driverInfo->experience = $request->experience;
			$driverInfo->pay = $request->pay;
			$driverInfo->save();

			$driver->attachRole('driver');
		} catch (\Throwable $th) {
			// dd($th);
			DB::rollback();
			Toastr::error('Server side error');
			return redirect()->back();
		}

		DB::commit();
		Toastr::success('driver added successfully', 'Success');
        return redirect()->back();
	}
    
    // update a specific driver in database.
    public function update(Request $request){
		// added some validation for form values. 
		$request->validate([
			'name' => 'required|string',
			'email' => 'required|string',
			'contact_no' => 'required|string',
			'license_no' => 'required|string',
			'experience' => 'nullable|numeric',
			'pay' => 'required|numeric'
		]);
		DB::beginTransaction(); // starting transaction for runtime db error.
		// if one query executed and other gives error then both will be roll backed. 
		try {
			// dd($request->all()); // debugging method die dump.
			$driver = User::findOrFail($request->id);
			$driver->name = $request->name;
			$driver->email = $request->email;
			$driver->contact_no = $request->contact_no;
			$driver->address = $request->address;
			$driver->save();

			$driverInfo = $driver->DriverInfo;
			$driverInfo->status = $request->status == 'on' ? 1 : 0; // checking if checkbox is checked or not. we are saving 0 and 1 bcz column is in boolean.
			$driverInfo->driver_id = $driver->id;
			$driverInfo->license_no = $request->license_no;
			$driverInfo->experience = $request->experience;
			$driverInfo->pay = $request->pay;
			$driverInfo->save();

			if($request->vehicle_id){
				$vehicle = Vehicle::findOrFail($request->vehicle_id);
				$vehicle->driver_id = $driver->id;
				$vehicle->save();
			}

		} catch (\Throwable $th) {
			// dd($th);
			DB::rollback();
			Toastr::error('Server side error');
			return redirect()->back();
		}

		DB::commit();
		Toastr::success('driver updated successfully', 'Success');
        return redirect()->back();
	}
}
