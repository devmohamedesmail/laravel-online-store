<?php

use App\Http\Controllers\admin\Cart_admin_conroller;
use App\Http\Controllers\admin\Country_controller;
use App\Http\Controllers\admin\Order_controller;
use App\Http\Controllers\admin\Payment_Options_controller;
use App\Http\Controllers\admin\Product_controller;
use App\Http\Controllers\admin\SettingController;
use App\Http\Controllers\admin\Slider_Baner_controller;
use App\Http\Controllers\front\Payment_controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\Category_controller;
use App\Http\Controllers\front\UserController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;





Route::group(['prefix' => LaravelLocalization::setLocale()], function () {

    Auth::routes();

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');




    // ++++++++++++++++++++++++++++++++++++++++++++ Admin Panel Routes Start +++++++++++++++++++++++++++++++++++++++++++++++
    Route::controller(SettingController::class)->group(function () {
        Route::get('/setting/page', 'setting')->name('setting.page');
        Route::post('/setting', 'update_setting')->name('update.setting');
        Route::get('media/library/page', 'media_library_page')->name('media.library.page');
        Route::get('visit/website','visit_website')->name('visit.website');
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
        Route::get('update/product/{id}', 'update_product')->name('update.product');
        Route::post('update/product/confirmation/{id}', 'update_product_confirmation')->name('update.product.confirmation');
        Route::get('delete/product/{id}', 'delete_product')->name('delete.product');

    });




    Route::controller(Cart_admin_conroller::class)->group(function () {
        Route::get('admin/cart/page', 'admin_cart_page')->name('admin.cart.page.control');
    });


    Route::controller(Country_controller::class)->group(function () {
        Route::get('countries/page', 'countries_page')->name('countries.page');
        Route::post('add/new/country', 'add_country')->name('add.country');
        Route::post('add/new/city', 'add_city')->name('add.city');
        Route::get('delete/country/{id}', 'delete_country')->name('delete.country');
        Route::get('delete/city/{id}', 'delete_city')->name('delete.city');
    });



    Route::controller(Slider_Baner_controller::class)->group(function () {
        Route::get('slider/page', 'slider_page')->name('slider.page');
        Route::post('add/new/slider', 'add_new_slider')->name('add.new.slider');
        Route::get('delete/slider/{id}', 'delete_slider')->name('delete.slider');
    });


    Route::controller(Payment_Options_controller::class)->group(function () {
        Route::get('payment/page', 'payment_page')->name('payment.page');
        Route::post('add/new/payment', 'add_new_payment')->name('add.new.payment');
        Route::get('toggle/active/payment/{id}', 'toggle_active_payment')->name('toggle.active.payment');
    });



    Route::controller(Order_controller::class)->group(function () {
        Route::get('show/orders/page', 'show_orders_page')->name('show.orders.page');
        Route::get('admin/orders/completed/{id}', 'admin_orders_completed')->name('admin.orders.completed');
    });



   


    // ++++++++++++++++++++++++++++++++++++++++++++ Admin Panel Routes End +++++++++++++++++++++++++++++++++++++++++++++++


    // ++++++++++++++++++++++++++++++++++++++++++++ User  Routes Start +++++++++++++++++++++++++++++++++++++++++++++++
    Route::controller(UserController::class)->group(function () {
        Route::get('/', 'index')->name('user.index');
        Route::get('poroduct/details/{id}/{slug?}/{extra?}', 'product_details')->name('product.details');
        Route::post('add/product/to/cart/{id}/{title}', 'add_cart')->name('add.cart');
        Route::get('cart/delete/{id}', 'cart_delete')->name('cart.delete');
        Route::post('/cart/increase/{id}',  'increaseQuantity')->name('cart.increase');
        Route::post('/cart/decrease/{id}', 'decreaseQuantity')->name('cart.decrease');
        Route::get('wishlist/page', 'wishlist')->name('wishlist');
        Route::get('contact/page', 'contact_page')->name('contact.page');
        Route::get('checkout/page/{product_id?}', 'checkout_page')->name('checkout.page');
        Route::get('shop/page/{id?}', 'shop_page')->name('shop.page');
        Route::get('cart/page', 'cart_page')->name('cart.page');
        Route::get('/cities/{country}', 'getCities')->name('get.cities');
        Route::get('/search', 'search')->name('product.search');
    });





    Route::controller(Payment_controller::class)->group(function () {
        Route::post('add/order', 'add_order')->name('add.order');


        // paypal routes
        Route::get('create-transaction', 'createTransaction')->name('createTransaction');
        Route::get('process-transaction', 'processTransaction')->name('processTransaction');
        Route::get('success-transaction',  'successTransaction')->name('successTransaction');
        Route::get('cancel-transaction',  'cancelTransaction')->name('cancelTransaction');
    });
    // ++++++++++++++++++++++++++++++++++++++++++++ User  Routes End +++++++++++++++++++++++++++++++++++++++++++++++




});
