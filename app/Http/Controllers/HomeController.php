<?php

namespace App\Http\Controllers;

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
            return view("front.index");
        }if ($user->role ==="admin") {
            return view("admin.index");
        } else {
            return view("front.index");
        }
        
    }
}
