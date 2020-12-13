<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Crypt;
use Toastr;
use DB;
use App\Notification;

class NotificationController extends Controller
{
    // shows the list of all notifications.
    public function index(){
		$notifications = Notification::all(); // get all notifications here.
		return view('admin.notification.index')->with([ 
			'notifications' => $notifications // sending the list to view.
		]);
    }
    
    // shows the creating a notification page.
	public function create(){
		return view('admin.notification.create');
    }

    // shows the edit page of notification.
    public function edit($id){
		$notification = Notification::find($id); // getting the speific notification to edit
		return view('admin.notification.edit')->with([
			'notification' => $notification, 
		]);
    }

    // shows the deleting method of notification.
    public function delete($id){
		try {
			Notification::destroy($id); // checks the if notification is deletable or not.
		} catch (\Throwable $th) {
            abort(404); // if argu is wrong then 404 page.
		}

		// Toastr is notification package we are using for project.
		Toastr::success('notification record deleted successfully', 'Success');
		return redirect()->back(); // redirecting back to list page.
	}
    
    // submitting record to Database.
	public function submit(Request $request){
		// dd($request->all());
		// added some validation for form values. 
		$request->validate([
			'title' => 'required|string',
			'message' => 'required|string'
		]);
		
		DB::beginTransaction(); // starting transaction for runtime db error.
		// if one query executed and other gives error then both will be roll backed. 
		try {
			// dd($request->all()); // debugging method die dump.
			$notification = new Notification;
			$notification->title = $request->title;
			$notification->message = $request->message;
			$notification->save();

		} catch (\Throwable $th) {
			dd($th);
			DB::rollback();
			Toastr::error('Server side error');
			return redirect()->back();
		}

		DB::commit();
		Toastr::success('notification added successfully', 'Success');
        return redirect()->back();
	}
    
    // update a specific notification in database.
    public function update(Request $request){
		// dd($request->all());
		$request->validate([
			'title' => 'required|string',
			'message' => 'required|string'
		]);
		
		DB::beginTransaction(); // starting transaction for runtime db error.
		// if one query executed and other gives error then both will be roll backed. 
		try {
			// dd($request->all()); // debugging method die dump.
			$notification = Notification::find($request->id);
			$notification->title = $request->title;
			$notification->message = $request->message;
			$notification->save();

		} catch (\Throwable $th) {
			dd($th);
			DB::rollback();
			Toastr::error('Server side error');
			return redirect()->back();
		}

		DB::commit();
		Toastr::success('notification added successfully', 'Success');
        return redirect()->back();
	}
}
