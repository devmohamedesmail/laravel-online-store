<?php

namespace App\Http\Controllers\front;

use App\Models\Cart;
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
        return view("front.pages.details", compact("product"));
        // return $product;
    }


    public function add_cart(Request $request, $id)
    {
        // Retrieve product and associated attributes
        $product = Product::with('attributes')->findOrFail($id);
        $user_id = auth()->check() ? auth()->id() : null;
        $session_id = !$user_id ? Session::getId() : null;
        
        // Get the selected variations from the request (the user's choices for each attribute)
        $selected_variations = $request->input('attributes', []);
    
        // Validation: Ensure all attributes are selected
        if ($product->attributes && $product->attributes->count() > 0) {
            foreach ($product->attributes as $attribute) {
                // Check if the attribute is selected in the request
                if (!isset($selected_variations[$attribute->id])) {
                    // If any attribute is not selected, return an error
                    return redirect()->back()->withErrors(['error' => 'Please select a value for "' . $attribute->name . '"'])->withInput();
                }
            }
        }
    
        // Check if the product already exists in the cart for the current user or session
        $cartItem = Cart::where('product_id', $product->id)
            ->where(function ($query) use ($user_id, $session_id) {
                if ($user_id) {
                    $query->where('user_id', $user_id);
                } else {
                    $query->where('session_id', $session_id);
                }
            })
            ->first();
    
        // If the item is already in the cart, update the quantity, otherwise create a new cart item
        if ($cartItem) {
            // Update the quantity if the item already exists
            $cartItem->quantity += $request->input('quantity', 1);
            $cartItem->selected_variations = json_encode($selected_variations); // Store selected variations as JSON
            $cartItem->save();
        } else {
            // Create new cart item
            $cart = new Cart();
            $cart->user_id = $user_id;
            $cart->session_id = $session_id;
            $cart->product_id = $product->id;
            $cart->quantity = $request->input('quantity', 1);
            $cart->price = $product->price;
            $cart->sale_price = $product->sale_price;
            $cart->image = $product->image;
            $cart->selected_variations = json_encode($selected_variations); // Store selected variations as JSON
            $cart->status = 'active';
            $cart->save();
        }
    
        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }
    
}
