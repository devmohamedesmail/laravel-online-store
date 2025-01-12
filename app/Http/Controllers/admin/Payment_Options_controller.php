<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Models\Paymentmethod;
use App\Models\Paymentsetting;
use App\Http\Controllers\Controller;

class Payment_Options_controller extends Controller
{
    // payment_page
    public function payment_page()
    {
        $paymentmethod = Paymentmethod::all();
        $paymentSetting = Paymentsetting::first();
        return view("admin.pages.payment-options.index", compact("paymentmethod","paymentSetting"));
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



    // payment Setting
    public function update_payment_setting(Request $request){
        $setting = Paymentsetting::first();
        if(!$setting){
            $setting = new Paymentsetting();
            $setting->stripe_key = $request->stripe_key;
            $setting->stripe_secret = $request->stripe_secret;
            $setting->paypal_client_id = $request->paypal_client_id;
            $setting->paypal_secret = $request->paypal_secret;
            $setting->save();
            return redirect()->back();
        }else{
            $setting->stripe_key = $request->stripe_key;
            $setting->stripe_secret = $request->stripe_secret;
            $setting->paypal_client_id = $request->paypal_client_id;
            $setting->paypal_secret = $request->paypal_secret;
            $setting->save();
            return redirect()->back();
        }
       
    }


}
