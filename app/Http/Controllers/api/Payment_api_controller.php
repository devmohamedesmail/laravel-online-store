<?php

namespace App\Http\Controllers\api;

use App\Models\Order;
use App\Models\Country;
use Stripe\StripeClient;
use Illuminate\Http\Request;
use App\Models\Paymentmethod;
use App\Http\Controllers\Controller;

class Payment_api_controller extends Controller
{
    
  
    public function add_order(Request $request)
    {
        $order = new Order();
        $payment = Paymentmethod::findOrFail($request->payment_method);
        $country  = Country::findOrFail($request->country);
        $order->name = $request->name;
        $order->phone = $request->phone;
        $order->address = $request->address;
        $order->email = $request->email;
        $order->country = $country->country_ar;
        $order->city = $request->city;
        $order->payment_method = $payment->type_ar;
       
        $cartItems = json_decode($request->input('cartItems'), true);
        $order->products = $cartItems;
        $totalPrice = 0;
        foreach ($cartItems as $item) {
            
           if ($item['product']['sale_price'] && $item['quantity']) {
            $totalPrice += $item['product']['sale_price'] * $item['quantity'];
            
           }else{
            $totalPrice += $item['product']['price'] * $item['quantity'];
           }
        }
        $requests = $request->all();

        
        if ($request->payment_method == 2) {
            return $this->pay_with_stripe($cartItems, $request->all(), $totalPrice,$order);
        }elseif ($request->payment_method == 1) {
            $order->save();
            return redirect()->back()->with('success', __('front.payment-success'));
        }elseif ($request->payment_method == 3){
            return $this->processTransaction($cartItems, $request->all(), $totalPrice,$order);
        };

        // $order->save();
        // return redirect()->back()->with('success', __('front.payment-success'));
        
    }




    public function pay_with_stripe($cartItems,$requests,$totalPrice,$order)
    {
       
        try {
            $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
    
            $charge = $stripe->charges->create([
                'amount' => $totalPrice * 100, // Convert to cents
                'currency' => 'AED',
                'source' => $requests['stripeToken'],
                'description' => 'Order Payment',
            ]);
           $order->save();
           return redirect()->back()->with('success', __('front.payment-success'));
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }



}
