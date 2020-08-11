<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Role;
use App\User;

class UserController extends Controller
{
    public function index(){
		$users = User::all();
		return view('admin.user.index')->with([
			'users' => $users
		]);
	}
	public function create(){
		$roles = Role::all();

		return view('admin.user.create')->with([
			'roles' => $roles
		]);
    }
    public function edit($id){
		$user = User::find($id);
		return view('admin.user.edit')->with([
			'user' => $user
		]);
    }
    public function delete($id){
		try {
			User::destroy($id);
		} catch (\Throwable $th) {
            abort(404);
		}
		return redirect()->back();
	}
    
	public function submit(Request $request){
        
        return redirect()->back();
	}
    
    public function update(Request $request){
		return redirect()->back();
	}

	
}
