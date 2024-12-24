<?php

namespace App\Http\Controllers\front;

use Stripe\Stripe;
use Stripe\PaymentIntent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;
use Stripe\StripeClient;


class Payment_controller extends Controller
{

   
    public function stripe()
    {
        return view("stripe");
    }
    public function checkout(Request $request)
    {
        // Set Stripe API key from environment file
        Stripe::setApiKey(env('STRIPE_SECRET'));

        try {
            // Create Stripe Checkout Session
            $checkout_session = Session::create([
                'payment_method_types' => ['card'],
                'line_items' => [[
                    'price_data' => [
                        'currency' => 'usd',
                        'product_data' => [
                            'name' => 'T-shirt',
                        ],
                        'unit_amount' => 2000, // Amount in cents ($20.00)
                    ],
                    'quantity' => 1,
                ]],
                'mode' => 'payment',  // Payment mode, 'payment' for one-time payments
                'success_url' => route('success'),  // After successful payment
                'cancel_url' => route('cancel'),    // If the user cancels
            ]);

            // Redirect the user to the Stripe Checkout page
            return redirect($checkout_session->url);
        } catch (\Exception $e) {
            // Handle any errors that occur during session creation
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function success()
    {
        return view('success'); // Show success page
    }

    public function cancel()
    {
        return view('cancel'); // Show cancellation page
    }


}
