<?php

namespace App\Http\Controllers\api\front;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoriesController extends Controller
{
    // showCategories
    public function showCategories(){
        $categories = Category::with('subcategories')->get();
        return response()->json($categories);
    }
}
