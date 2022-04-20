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

        Route::resource('categories', 'CategoriesController')->except('show');
    });
});

Route::group(['namespace' => 'Frontend', 'as' => 'category.'],function () {
    Route::get('/category/{slug}', 'CategoriesController@show')->name('show');
});
