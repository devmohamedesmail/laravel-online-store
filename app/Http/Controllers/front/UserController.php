<?php

namespace App\Http\Controllers\front;

use App\Models\Cart;
use App\Models\City;
use App\Models\Country;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    // index
    public function index()
    {
        return view("front.index");
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
                    // If any attribute is not selected, return an error
                    return redirect()->back()->withErrors(['error' => 'Please select a value for "' . $attribute->name . '"'])->withInput();
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
            return redirect()->back();
        } else {
            $cart = new Cart();
            $cart->user_id = $user_id;
            $cart->session_id = $session_id;
            $cart->product_id = $product->id;
            $cart->quantity = $request->input('quantity', 1);
            $cart->price = $product->price;
            $cart->sale_price = $product->sale_price;
            $cart->image = $product->image;
            $cart->selected_variations = $selected_variations;
            $cart->status = 'active';
            $cart->save();
            return redirect()->back();
        }





        //    return $selected_variations;
    }



    // wishlist page
    public function wishlist(){
        return view('front.pages.wishlist');
    }

    public function contact_page(){
        return view('front.pages.contact');
    }



    public function checkout_page($product_id = null){
        $countries = Country::all();
        return view('front.pages.checkout',compact('countries'));
    }



    public function shop_page(){
        return view("front.pages.shop");
    }
    public function cart_page(){
        return view("front.pages.cart");
    }



    public function getCitiesByCountry(Request $request)
{
    $countryId = $request->country_id;
    $cities = City::where('country_id', $countryId)->get();

    return response()->json($cities);
}



}
