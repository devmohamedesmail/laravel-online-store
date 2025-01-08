<?php

namespace App\Providers;

use Auth;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Setting;
use App\Models\Category;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class GlobalDataProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $setting = Setting::first();

        if (!$setting) {
            $setting = new Setting();
            $setting->name_en = "Store Name En";
            $setting->name_ar = "Store Name Ar";
            $setting->description = "Description";
            $setting->email = "store@gmail.com";
            $setting->phone = "1234567890";
            $setting->address = "Store Address";
            $setting->instagram = "Instagram Link";
            $setting->whatsapp = "Whatsapp Number";
            $setting->facebook = "Facebook Link";
            $setting->twitter = "Twitter Link";
            $setting->youtube = "Youtube Link";
            $setting->logo = null;
            $setting->favicon = null;
            $setting->save();

        }

        view()->share('setting', $setting);

        $categories = Category::all();
        view()->share('categories', $categories);


        $all_products = Product::all();
        view()->share('all_products', $all_products);

      
        View::composer('*', function ($view) {
            $cartItems = collect(); 
            if (auth()->check()) {
                $cartItems = Cart::with('product')->where('user_id', auth()->id())->get();
            } else {
                $sessionId = session()->getId();
                $cartItems = Cart::with('product')->where('session_id', $sessionId)->get();
            }

            $view->with('cartItems', $cartItems);
           
        });
      


    }
}
