<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Paymentmethod;
use Illuminate\Http\Request;

class Payment_Options_controller extends Controller
{
    // payment_page
    public function payment_page()
    {
        $paymentmethod = Paymentmethod::all();
        return view("admin.pages.payment-options.index", compact("paymentmethod"));
    }

    public function add_new_payment(Request $request){
        $option  = new Paymentmethod();
        $option->type_en = $request->type_en;
        $option->type_ar = $request->type_ar;
        $option->save();
        return redirect()->back();

    }


    public function toggle_active_payment($id){
        $paymentmethod = Paymentmethod::findOrFail($id);
        if($paymentmethod->status == 1){
            $paymentmethod->status = 0;
        }else{
            $paymentmethod->status = 1;
        }
        $paymentmethod->save();
        return redirect()->back();
    }



}
