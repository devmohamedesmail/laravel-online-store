<?php

namespace App\Http\Controllers\admin;

use App\Models\Slider;
use App\Models\Setting;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class SettingController extends Controller
{
    // setting
    public function setting(){
        return view("admin.pages.setting.setting");
    }


    /// update setting
    public function update_setting(Request $request){
        try {
            $seeting = Setting::first();
            $seeting->name_en = $request->name_en;
            $seeting->name_ar = $request->name_ar;
            $seeting->description = $request->description;
            $seeting->email = $request->email;
            $seeting->phone = $request->phone;
            $seeting->address = $request->address;
            $seeting->facebook = $request->facebook;
            $seeting->instagram = $request->instagram;
            $seeting->linkedin = $request->linkedin;
            $seeting->youtube = $request->youtube;
            $seeting->twitter = $request->twitter;
            $seeting->whatsapp = $request->whatsapp;
            $seeting->appurl = $request->appurl;
            $seeting->appurl = $request->appurl;
            $seeting->currency_en = $request->currency_en;
            $seeting->currency_ar = $request->currency_ar;
           
            $logo = $request->logo;
            if($logo){
                $imageName = Str::uuid() . '.' . $logo->getClientOriginalExtension();
                $logo->move(public_path('/uploads'), $imageName);
                $seeting->logo = $imageName;
            }
            
            $seeting->save();
            return redirect()->back()->with("success", __('translate.updated'));

        } catch (\Throwable $th) {
            //throw $th;
        }
    }



    // media library page
    public function media_library_page(){
        $imagePath = public_path('uploads'); // Path to the media folder
        $images = File::files($imagePath);
        return view("admin.pages.media-library.index", compact("images"));
    }


    public function visit_website(){
        $sliders = Slider::all();
        return view('front.index',compact('sliders'));
    }









}
