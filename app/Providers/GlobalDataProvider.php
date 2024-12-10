<?php

namespace App\Providers;

use App\Models\Setting;
use App\Models\Category;
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
            $setting->name_en = "Default Name En";
            $setting->name_ar = "Default Name Ar";
            $setting->email = "default@domain.com";
            $setting->phone = "1234567890";
            $setting->address = "Default Address";
            $setting->logo = null;
            $setting->favicon = null;
            $setting->save();
             
        }

        view()->share('setting', $setting);

        $categories = Category::all();
        view()->share('categories', $categories);
    }
}
