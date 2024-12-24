<?php

namespace App\Http\Controllers\admin;

use App\Models\City;
use App\Models\Country;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Country_controller extends Controller
{
    //

    public function countries_page(){
        $countries = Country::with("cities")->get();
        return view("admin.pages.countries.index",compact("countries"));
    //    return response()->json($countries);
    }


    public function add_country(Request $request){
        $country = new Country();
        $country->country_en = $request->country_en;
        $country->country_ar = $request->country_ar;
        $country->save();
        return redirect()->back();
    }
    public function add_city(Request $request){
        $city = new City();
        $city->country_id = $request->country;
        $city->city_en = $request->city_en;
        $city->city_ar = $request->city_ar;
        $city->save();
        return redirect()->back();
    }



    public function delete_country($id){
        $country = Country::find($id);
        $country->delete();
        return redirect()->back();
    }


    public function delete_city($id){
        $city = City::find($id);
        $city->delete();
        return redirect()->back();
    }
}
