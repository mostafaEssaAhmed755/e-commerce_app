<?php

Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'as' => 'admin.'],function (){

    Route::get('login','LoginController@showLoginForm')->name('login');
    Route::post('login','LoginController@login')->name('login.post');
    Route::post('logout','LoginController@logout')->name('logout');

    Route::group(['middleware' => ['auth:admin']],function () {

        Route::get('/',function (){
            return view('admin.dashboard.index');
        })->name('dashboard');

        Route::get('settings','SettingController@index')->name('settings');
        Route::post('settings','SettingController@update')->name('settings.update');

    });
});

Route::group(['namespace' => 'Frontend'],function () {

    Route::view('/', 'frontend.pages.homepage');

});
