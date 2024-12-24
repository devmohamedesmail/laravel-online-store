<?php

namespace App\Http\Controllers\admin;

use App\Models\Slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSiderRequest;
use App\Http\Requests\StoreSliderRequest;

class Slider_Baner_controller extends Controller
{
    // slider.page
    public function slider_page()
    {   
        $sliders = Slider::all();
        return view('admin.pages.sliders-banners.index',compact('sliders'));
    }


    public function add_new_slider(StoreSliderRequest $request){
        $slider = new Slider();
        $slider->title = $request->title;
        $slider->description = $request->description;
      
        $image = $request->image;
        if($image){
            $imageName = time() .'.'. $image->getClientOriginalExtension();
            $request->image->move(public_path('uploads/sliders'), $imageName);
            $slider->image = $imageName;
        }
        $slider->save();
        return redirect()->back();
    }


    public function delete_slider($id){
        Slider::findOrFail($id)->delete();
        return redirect()->back();
    }
}
