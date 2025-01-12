<?php

namespace App\Http\Controllers\api;

use App\Models\Slider;
use App\Models\Product;
use App\Models\Setting;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Paymentsetting;
use App\Http\Controllers\Controller;

class Api_controller extends Controller
{
    // 

    public function showCategories(){
      
        try {
            $categories = Category::all();
            return response()->json(['data'=>$categories,'status'=>200,'msg'=> 'success']);
        } catch (\Throwable $th) {
            return response()->json(['status'=> 500,'msg'=> $th->getMessage()]);
        }
    }



    public function show_category_products($id){
        try {
            $products = Category::with('products.attributes.values','products.variations')->findOrFail($id);
            return response()->json(['data'=>$products,'status'=>200,'msg'=> 'success']);
        } catch (\Throwable $th) {
            return response()->json(['status'=> 500,'msg'=> $th->getMessage()]);
        }
    }


    public function show_products(){    
        try {
            $products = Product::with('category','attributes.values','variations','options')->get();
            return response()->json(['data'=>$products,'status'=> 200,'msg'=> 'success']);
        } catch (\Throwable $th) {
            return response()->json(['status'=> 500,'msg'=> $th->getMessage()]);
        }
    }
    
    
    // showSetting
    public function showSetting(){
        try {
            $setting = Setting::first(); 
            return response()->json(['data'=>$setting,'status'=> 200,'msg'=> 'success']);
        } catch (\Throwable $th) {
            return response()->json(['status'=> 500,'msg'=> $th->getMessage()]);
        }
    }

    public function show_slider(){
        $sliders = Slider::all();
        return response()->json(['data'=>$sliders,'status'=> 200,'msg'=> 'success']);
    }

    public function show_payment_setting(){
        $paymentSetting = Paymentsetting::first();
        return response()->json(['data'=>$paymentSetting,'status'=> 200,'msg'=> 'success']);
    }
}
