<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Attendence;
use App\UserAttendence;
use App\User;
use App\Vehicle;
use App\UserVehicle;

use Toastr;
use DB;
use Auth;

class AttendenceController extends Controller
{
    //
    // shows the list of all attendences.
    public function index(){

        $vehicle = Vehicle::where('driver_id', auth()->user()->id)->first();
        $attendences = UserAttendence::where('driver_id', auth()->user()->id)->get();
        $userVehicles = UserVehicle::where('vehicle_id', $vehicle->id)->get();

		return view('driver.attendence.index')->with([ 
            'attendences' => $attendences, // sending the list to view.
            'userVehicles' => $userVehicles
		]);
    }
    
    // shows the creating a attendence page.
	public function create(){
        $vehicle = Vehicle::where('driver_id', auth()->user()->id)->first();
        $userVehicles = UserVehicle::where('vehicle_id', $vehicle->id)->get();

		return view('driver.attendence.create')->with([
			'userVehicles' => $userVehicles
		]);
    }

    // submitting record to Database.
	public function submit(Request $request){
		// dd($request->all());
		// added some validation for form values. 
		
		
		DB::beginTransaction(); // starting transaction for runtime db error.
		// if one query executed and other gives error then both will be roll backed. 
		try {
			// dd($request->all()); // debugging method die dump.
			$ua = new UserAttendence;
			$ua->note = $request->note;
			$ua->driver_id = auth()->user()->id;
			$ua->save();

			foreach($request->user as $user){
                $a = new Attendence;
                $a->user_attendences_id = $ua->id;
                $a->user_id = $user;
                $a->save();

            }
			
		} catch (\Throwable $th) {
			DB::rollback();

			// dd($th);
			Toastr::error('Server side error');
			return redirect()->back();
		}

		DB::commit();
		Toastr::success('attendence added successfully', 'Success');
        return redirect()->back();
	}
    
}
