<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\Api_controller;
use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\Payment_api_controller;
use App\Http\Controllers\api\front\CategoriesController;



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});






Route::controller(Api_controller::class)->group(function () {
    Route::get('show/categories', 'showCategories')->name('show.categroies');
    Route::get('show/products', 'show_products')->name('show.products');
    Route::get('show/category/products/{id}','show_category_products')->name('show.category.products');
});



Route::controller(Payment_api_controller::class)->group(function () { 
    // stripe payment

 });



 Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');

});