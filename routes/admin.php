<?php

Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'as' => 'admin.'],function (){
    Route::get('login','LoginController@showLoginForm')->name('login');
    Route::post('login','LoginController@login')->name('login.post');
    Route::post('logout','LoginController@logout')->name('logout');

    Route::group(['middleware' => ['auth:admin']],function (){
        Route::get('/',function (){
            return view('admin.dashboard.index');
        })->name('dashboard');

        Route::get('settings','SettingController@index')->name('settings');
        Route::post('settings','SettingController@update')->name('settings.update');

        Route::resource('categories', 'CategoryController')->except('show');

        Route::resource('attributes', 'AttributeController')->except('show');

        Route::resource('attributesValues', 'AttributeValueController')->except(['index', 'edit']);

        Route::resource('brands','BrandController')->except('show');

        Route::group(['prefix' => 'products', 'as' => 'products.'], function () {
            Route::post('/{id}/images/upload','ProductImageController@upload')->name('images.upload');
            Route::delete('/images/{id}/delete','ProductImageController@delete')->name('images.delete');

            Route::get('attributes', 'ProductAttributeController@loadAttributes')->name('attributes');
            Route::post('/{id}/attributes', 'ProductAttributeController@productAttributes')->name('attributes');
            Route::post('attributes/{id}/values', 'ProductAttributeController@loadValues')->name('attributes.values');
            Route::post('{id}/attributes/add', 'ProductAttributeController@addAttribute')->name('attributes.add');
            Route::post('{id}/attributes/delete', 'ProductAttributeController@deleteAttribute')->name('attributes.delete');
        });

        Route::resource('products','ProductController');

        Route::group(['prefix' => 'orders'], function () {
            Route::get('/', 'OrderController@index')->name('orders.index');
            Route::get('/{order}/show', 'OrderController@show')->name('orders.show');
        });

    });
});
