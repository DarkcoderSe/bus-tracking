<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\User;
use App\Payment;
use Toastr;
use Carbon\Carbon;


class PaymentController extends Controller
{
    //
    public function submit(Request $request){
        $request->validate([
            'amount' => 'required|numeric',
            'challan' => 'mimes:png,jpg,pdf,jpeg'
        ]);

        $pay = new Payment;
        $pay->amount = $request->amount;
        if ($request->hasFile('challan')) {

            $image = $request->file('challan');
            $name = 'idf' . time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/images/challan');
            $image->move($destinationPath, $name);
            $pay->challan_image = $name;
            
        }
        $pay->title = 'Paid fee challan';
        $pay->user_id = $request->user_id;
        $pay->save();

        $now = Carbon::now();
        $nextPayment = $now->addDays(31);

        $user = User::find($request->user_id);
        $user->next_payment = $nextPayment;
        $user->save();

        Toastr::success('Challan added successfully', 'Paid');
        return redirect()->back();
        
    }
}
