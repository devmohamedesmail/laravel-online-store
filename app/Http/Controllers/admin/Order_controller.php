<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Order_controller extends Controller
{
    // show_orders_page

    public function show_orders_page(){

        return view("admin.pages.orders.index");
    }
}
