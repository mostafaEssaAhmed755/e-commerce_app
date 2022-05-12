<?php

Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'as' => 'admin.'],function (){

    Route::group(['middleware' => ['auth:admin']],function () {

        Route::group(['prefix' => 'products', 'as' => 'products.'], function () {

            Route::post('/{id}/images/upload', 'ProductImageController@upload')->name('images.upload');
            Route::delete('/images/{id}/delete', 'ProductImageController@delete')->name('images.delete');

            Route::get('attributes', 'ProductAttributeController@loadAttributes')->name('attributes');
            Route::post('/{id}/attributes', 'ProductAttributeController@productAttributes')->name('attributes');
            Route::post('attributes/{id}/values', 'ProductAttributeController@loadValues')->name('attributes.values');
            Route::post('{id}/attributes/add', 'ProductAttributeController@addAttribute')->name('attributes.add');
            Route::post('{id}/attributes/delete', 'ProductAttributeController@deleteAttribute')->name('attributes.delete');
        });

        Route::resource('products', 'ProductsController');

        Route::resource('attributes', 'AttributeController')->except('show');

        Route::resource('attributesValues', 'AttributeValueController')->except(['index', 'edit']);

        Route::resource('brands', 'BrandController')->except('show');
    });
});

Route::group(['namespace' => 'Frontend', 'as' => 'product.'],function () {

    Route::get('/product/{slug}', 'Frontend\ProductsController@show')->name('show');

});
