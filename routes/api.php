<?php

use App\Http\Controllers\api\front\CategoriesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});






Route::controller(CategoriesController::class)->group(function(){
    Route::get('show/categories','showCategories');
});
