<?php

namespace App\Http\Controllers\admin;

use App\Models\Cart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Cart_admin_conroller extends Controller
{
    // admin_cart_page
    public function admin_cart_page(){
        $cart = Cart::with('user','products')->get();
        return view("admin.pages.cart.index",compact("cart"));
        
    }
}
