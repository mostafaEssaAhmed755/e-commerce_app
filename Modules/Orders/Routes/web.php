<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'as' => 'admin.'],function (){
    Route::group(['middleware' => ['auth:admin']],function () {
        Route::group(['prefix' => 'orders'], function () {
            Route::get('/', 'OrderController@index')->name('orders.index');
            Route::get('/{order}/show', 'OrderController@show')->name('orders.show');
        });
    });
});

Route::group(['namespace' => 'Frontend'],function () {

    Route::post('cart/item/{id}/add', 'Frontend\CartController@addToCart')->name('cart.add.item');
    Route::get('/cart', 'Frontend\CartController@getCart')->name('checkout.cart');
    Route::get('/cart/item/{id}/remove', 'Frontend\CartController@removeItem')->name('checkout.cart.remove');
    Route::get('/cart/clear', 'Frontend\CartController@clearCart')->name('checkout.cart.clear');
});

