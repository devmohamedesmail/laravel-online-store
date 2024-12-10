<?php

use App\Http\Controllers\admin\Product_controller;
use App\Http\Controllers\admin\SettingController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\Category_controller;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/







Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');




Route::group(['prefix' => LaravelLocalization::setLocale()], function () {


    Route::get('/', function () {
        return view('admin.index');
    });


    Route::controller(SettingController::class)->group(function () {
        Route::get('/setting/page', 'setting')->name('setting.page');
        Route::post('/setting', 'update_setting')->name('update.setting');
    });

    
    Route::controller(Category_controller::class)->group(function () {
        Route::get('/categories/page', 'categories_page')->name('categories.page');
        Route::post('add/categories', 'add_category')->name('add.category');
        Route::get('edit/category/{id}', 'edit_category')->name('edit.category');
        Route::post('edit/category/confirmation/{id}', 'edit_category_confirmartion')->name('edit.category.confirmation');  
        Route::get('delete/category/{id}', 'delete_category')->name('delete.category');
   
    });




    // products
    Route::controller(Product_controller::class)->group(function () {
        Route::get('add/product/page', 'add_product_page')->name('add.product.page');
        Route::get('show/products/page', 'show_products_page')->name('show.products.page');
        Route::post('add/products', 'add_product')->name('add.new.product');
       
    });


});
