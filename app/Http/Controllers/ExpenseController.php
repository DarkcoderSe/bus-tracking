<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Toastr;
use App\User;
use App\Expense;


class ExpenseController extends Controller
{
    // shows the list of all users.
    public function index(){
        $transactions = Expense::where('driver_id', auth()->user()->id)->get();
        // dd($transactions);
		return view('driver.expense.index')->with([ 
			'transactions' => $transactions // sending the list to view.
		]);
    }
    
    // shows the creating a user page.
	public function create(){
		return view('driver.expense.create');
    }

    // shows the edit page of user.
    public function edit($id){
		$transaction = Expense::find($id); // getting the speific user to edit
		return view('driver.expense.edit')->with([
            'transaction' => $transaction
		]);
    }

    // shows the deleting method of user.
    public function delete($id){
		try {
			Expense::destroy($id); // checks the if expense is deletable or not.
		} catch (\Throwable $th) {
            abort(404); // if argu is wrong then 404 page.
		}

		// Toastr is notification package we are using for project.
		Toastr::success('transaction deleted successfully', 'Deleted!');
		return redirect()->back(); // redirecting back to list page.
	}
    
    // submitting record to Database.
	public function submit(Request $request){
		// dd($request->all());
		// added some validation for form values. 
		$request->validate([
			'type' => 'required|string',
			'amount' => 'required|numeric',
			'title' => 'required|string'
		]);
		
		DB::beginTransaction(); // starting transaction for runtime db error.
		// if one query executed and other gives error then both will be roll backed. 
		try {
			// dd($request->all()); // debugging method die dump.
            $transaction = new Expense;
            $transaction->type = $request->type;
            $transaction->title = $request->title;
            $transaction->amount = $request->amount;
            $transaction->driver_id = auth()->user()->id;
			$transaction->save();



		} catch (\Throwable $th) {
			dd($th);
			DB::rollback();
			Toastr::error('Server side error');
			return redirect()->back();
		}

		DB::commit();
		Toastr::success('transaction created successfully', 'Created!');
        return redirect()->back();
	}
    
    public function update(Request $request){
		// dd($request->all());
		// added some validation for form values. 
		$request->validate([
			'type' => 'required|string',
			'amount' => 'required|numeric',
            'title' => 'required|string',
            'id' => 'required|numeric'
		]);
		
		DB::beginTransaction(); // starting transaction for runtime db error.
		// if one query executed and other gives error then both will be roll backed. 
		try {
			// dd($request->all()); // debugging method die dump.
            $transaction = Expense::findOrFail($request->id);
            $transaction->type = $request->type;
            $transaction->title = $request->title;
            $transaction->amount = $request->amount;
			
			$transaction->save();



		} catch (\Throwable $th) {
			// dd($th);
			DB::rollback();
			Toastr::error('Server side error');
			return redirect()->back();
		}

		DB::commit();
		Toastr::success('transaction updated successfully', 'Updated!');
        return redirect()->back();
	}
}
