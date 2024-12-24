<?php

namespace App\Http\Controllers\front;
use Stripe\Stripe;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Stripe\StripeClient;



class Payment_controller extends Controller
{

    public $stripe;
   
    public function __construct()
    {
        $this->stripe = new StripeClient(
            config('stripe.api_key.secret')
        );
    }


    public function createCheckoutSession(Request $request)
    {
        try {
            
    
            // Create the checkout session
            $checkoutSession = $this->stripe->checkout->sessions->create([
                'payment_method_types' => ['card'],
                'line_items' => [
                    [
                        'price_data' => [
                            'currency' => 'usd',
                            'product_data' => ['name' => 'Product'],
                            'unit_amount' => 1000, // $10.00 in cents
                        ],
                        'quantity' => 1,
                    ],
                ],
                'mode' => 'payment',
                'success_url' => route('checkout.success') . '?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => route('checkout.cancel'),
            ]);
    
            return redirect($checkoutSession->url);

            // return response()->json(['clientSecret' => $checkoutSession->client_secret]);
    
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to create checkout session: ' . $e->getMessage()], 500);
        }
    }




    // -----------------------------------------------
    
    


}
