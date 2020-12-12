<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Role;
use App\User;
use App\Vehicle;
use App\UserVehicle;

use DB;
use Hash;

use Toastr;
class UserController extends Controller
{
	// shows the list of all users.
    public function index(){
		$users = User::whereRoleIs(['student', 'teacher'])->get(); // get all users here.
		return view('admin.user.index')->with([ 
			'users' => $users // sending the list to view.
		]);
    }
    
    // shows the creating a user page.
	public function create(){
		$vehicles = Vehicle::all(); //sending the list of vehicles.
		return view('admin.user.create')->with([
			'vehicles' => $vehicles
		]);
    }

    // shows the edit page of user.
    public function edit($id){
		$vehicles = Vehicle::all(); //sending the list of vehicles.
		$user = User::find($id); // getting the speific user to edit
		return view('admin.user.edit')->with([
			'user' => $user, // sending user record to edit view.
			'vehicles' => $vehicles
		]);
    }

    // shows the deleting method of user.
    public function delete($id){
		try {
			User::destroy($id); // checks the if user is deletable or not.
		} catch (\Throwable $th) {
            abort(404); // if argu is wrong then 404 page.
		}

		// Toastr is notification package we are using for project.
		Toastr::success('user record deleted successfully', 'Success');
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
			'reg_no' => 'required|string',
			'address' => 'nullable|string',
			'vehicle_id' => 'required|integer'
		]);
		
		DB::beginTransaction(); // starting transaction for runtime db error.
		// if one query executed and other gives error then both will be roll backed. 
		try {
			// dd($request->all()); // debugging method die dump.
			$user = new User;
			$user->name = $request->name;
			$user->email = $request->email;
			$user->password = Hash::make($request->password);
			$user->contact_no = $request->contact_no;
			$user->reg_no = $request->reg_no;
			$user->address = $request->address;
			
			$user->save();

			$user->attachRole($request->role);

			$userVehicle = new UserVehicle;
			$userVehicle->user_id = $user->id;
			$userVehicle->vehicle_id = $request->vehicle_id;
			$userVehicle->save();


		} catch (\Throwable $th) {
			dd($th);
			DB::rollback();
			Toastr::error('Server side error');
			return redirect()->back();
		}

		DB::commit();
		Toastr::success('user added successfully', 'Success');
        return redirect()->back();
	}
    
    // update a specific user in database.
    public function update(Request $request){
		// dd($request->all());
		// added some validation for form values. 
		$request->validate([
			'name' => 'required|string',
			'email' => 'required|string',
			'contact_no' => 'required|string',
			'reg_no' => 'required|string',
			'address' => 'nullable|string',
			'vehicle_id' => 'required|integer'
		]);
		
		DB::beginTransaction(); // starting transaction for runtime db error.
		// if one query executed and other gives error then both will be roll backed. 
		try {
			// dd($request->all()); // debugging method die dump.
			$user = User::findOrFail($request->id);
			$user->name = $request->name;
			$user->email = $request->email;
			$user->contact_no = $request->contact_no;
			$user->reg_no = $request->reg_no;
			$user->address = $request->address;
			$user->save();

			$userVehicle = $user->UserVehicle;
			$userVehicle->vehicle_id = $request->vehicle_id;
			$userVehicle->save();

		} catch (\Throwable $th) {
			// dd($th);
			DB::rollback();
			Toastr::error('Server side error');
			return redirect()->back();
		}

		DB::commit();
		Toastr::success('user updated successfully', 'Success');
        return redirect()->back();
	}
}
