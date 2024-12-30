<?php

namespace App\Http\Controllers\admin;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Order_controller extends Controller
{
    // show_orders_page

    public function show_orders_page(){
        $orders = Order::orderBy("created_at","desc")->get();
      
       return view("admin.pages.orders.index",compact("orders"));
    }
}
