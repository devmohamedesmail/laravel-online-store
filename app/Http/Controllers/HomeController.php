<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // return view('home');
        $user = auth()->user();
        if($user->role ==="user"){
            $sliders = Slider::all();
            return view("front.index",compact("sliders"));
        }if ($user->role ==="admin") {
            return view("admin.index");
        } else {
            $sliders = Slider::all();
            return view("front.index",compact("sliders"));
        }
        
    }
}
