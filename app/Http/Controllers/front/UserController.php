<?php

namespace App\Http\Controllers\front;

use App\Models\Cart;
use App\Models\City;
use App\Models\Slider;
use App\Models\Country;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Paymentmethod;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    // index
    public function index()
    {
        $sliders = Slider::all();
        return view("front.index", compact("sliders"));
    }



    public function product_details($id)
    {

        $product = Product::with('category', 'attributes.values', 'variations')->findOrFail($id);
        $related_products = Product::where('category_id', $product->category->id)->get();
        return view("front.pages.details", compact("product", "related_products"));

    }


    public function add_cart(Request $request, $id)
    {
        $product = Product::with('attributes')->findOrFail($id);
        $user_id = auth()->check() ? auth()->id() : null;
        $session_id = !$user_id ? Session::getId() : null;


        $selected_variations = $request->input('attributes', []);

        if ($product->attributes && $product->attributes->count() > 0) {
            foreach ($product->attributes as $attribute) {

                if (!isset($selected_variations[$attribute->name])) {

                    // return redirect()->back()->withErrors(['error' => '__("front.error-select") "' . $attribute->name . '"'])->withInput();
                    return redirect()->back()->withErrors([
                        'error' => __('front.error-select', ['attribute' => $attribute->name])
                    ])->withInput();
                }
            }
        }


        $cartItem = Cart::where('product_id', $product->id)
            ->where(function ($query) use ($user_id, $session_id) {
                if ($user_id) {
                    $query->where('user_id', $user_id);
                } else {
                    $query->where('session_id', $session_id);
                }
            })
            ->where('selected_variations', json_encode($selected_variations)) // Ensure the variations are unique for each combination
            ->first();


        if ($cartItem) {

            $cartItem->quantity += $request->input('quantity', 1);
            $cartItem->selected_variations = $selected_variations;
            $cartItem->save();
            return redirect()->back()->with('success', __('front.added'));
        } else {
            $cart = new Cart();
            $cart->user_id = $user_id;
            $cart->session_id = $session_id;
            $cart->product_id = $product->id;
            $cart->quantity = $request->input('quantity', 1);
            $cart->selected_variations = $selected_variations;
            $cart->status = 'active';
            $cart->save();
            return redirect()->back()->with('success', __('front.added'));


        }





        //    return $selected_variations;
    }




    // Delete Cart Item
    public function cart_delete($id)
    {
        $cart = Cart::findOrFail($id);
        $cart->delete();
        return redirect()->back()->with('success', __('front.deleted'));
    }



    public function increaseQuantity($id)
    {
        $cartItem = Cart::find($id);
        if ($cartItem) {
            $cartItem->quantity += 1;
            $cartItem->save();
        }
        return response("<span id='quantity-{$cartItem->id}'>{$cartItem->quantity}</span>");

    
       
    }

    public function decreaseQuantity($id)
    {
        $cartItem = Cart::find($id);
        if ($cartItem && $cartItem->quantity > 1) {
            $cartItem->quantity -= 1;
            $cartItem->save();
        }
        return response("<span id='quantity-{$cartItem->id}'>{$cartItem->quantity}</span>");

    }



    // wishlist page
    public function wishlist()
    {
        return view('front.pages.wishlist');
    }

    public function contact_page()
    {
        return view('front.pages.contact');
    }



    public function checkout_page($product_id = null)
    {
        $countries = Country::all();
        $payment_methods = Paymentmethod::where('status', 1)->get();
        return view('front.pages.checkout.checkout', compact('countries', 'payment_methods'));
    }



    public function shop_page($id = null)
    {


        if ($id) {
            $products = Product::where('id', '=', $id)->get();
            return view("front.pages.shop", compact("products", ));
        } else {
            $products = Product::all();
            return view("front.pages.shop", compact("products", ));
        }

    }
    public function cart_page()
    {
        return view("front.pages.cart");
    }



    public function getCities($country)
    {
        // Log the received country

        $cities = City::where('country_id', $country)->get();

        if ($cities->isEmpty()) {
            return response()->json(['error' => 'No cities found for this country'], 404);
        }

        return response()->json($cities);
    }




    // search 
    public function search(Request $request)
    {
        $query = $request->input('search');
        $products = Product::where('name', 'LIKE', "%{$query}%")->get();



        return view('front.pages.search', compact('products', 'query'));
    }



}
