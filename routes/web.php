<?php

use Illuminate\Support\Facades\Route;

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
//require 'admin.php';

Auth::routes();

//Route::view('/', 'frontend.pages.homepage');
//
//Route::get('/product/{slug}', 'Frontend\ProductController@show')->name('product.show');
//
//Route::post('cart/item/{id}/add', 'Frontend\CartController@addToCart')->name('cart.add.item');
//Route::get('/cart', 'Frontend\CartController@getCart')->name('checkout.cart');
//Route::get('/cart/item/{id}/remove', 'Frontend\CartController@removeItem')->name('checkout.cart.remove');
//Route::get('/cart/clear', 'Frontend\CartController@clearCart')->name('checkout.cart.clear');
//
//Route::group(['middleware' => ['auth']], function () {
//    Route::get('/checkout', 'Frontend\CheckoutController@getCheckout')->name('checkout.index');
//    Route::post('/checkout/order', 'Frontend\CheckoutController@placeOrder')->name('checkout.place.order');
//    Route::get('checkout/payment/complete', 'Frontend\CheckoutController@complete')->name('checkout.payment.complete');
//    Route::get('account/orders', 'Frontend\AccountController@getOrders')->name('account.orders');
//});
