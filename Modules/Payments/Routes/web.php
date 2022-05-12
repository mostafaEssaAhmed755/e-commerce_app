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

Route::group(['middleware' => ['auth']], function () {
    Route::get('/checkout', 'Frontend\CheckoutController@getCheckout')->name('checkout.index');
    Route::post('/checkout/order', 'Frontend\CheckoutController@placeOrder')->name('checkout.place.order');
    Route::get('checkout/payment/complete', 'Frontend\CheckoutController@complete')->name('checkout.payment.complete');
    Route::get('account/orders', 'Frontend\AccountController@getOrders')->name('account.orders');
});
