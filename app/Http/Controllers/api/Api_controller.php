<?php

namespace App\Http\Controllers\api;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Api_controller extends Controller
{
    // 

    public function showCategories(){
        $categories = Category::all();
        return response()->json($categories);
    }


    public function products(){
        $products = Product::with('category','attributes.values','variations')->get();
        return response()->json($products);
    }
}
