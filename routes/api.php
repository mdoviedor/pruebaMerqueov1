<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes PRUEBA MERQUEO JESUS JIMENEZ
|--------------------------------------------------------------------------
|
*/

Route::group(['prefix' => 'v1'], function(){

    // PRODUCTOS
    Route::group(['prefix' => 'product'], function(){

        Route::post('load', 'ProductsController@load');
        Route::get('all', 'ProductsController@all');
        Route::get('{id}', 'ProductsController@find');

    });

    // PROVEEDORES
    Route::group(['prefix' => 'provider'], function(){

        Route::post('load', 'ProvidersController@load');
        Route::get('all', 'ProvidersController@all');
        Route::get('{id}', 'ProvidersController@find');

    });


    // ORDENES
    Route::group(['prefix' => 'order'], function(){

        Route::post('load', 'OrdersController@load');
        Route::get('all', 'OrdersController@all');

    });

    // REPORTES
    Route::group(['prefix' => 'report'], function(){

        Route::get('A', 'ReportsController@reportA');
        Route::get('B', 'ReportsController@reportB');
        Route::get('C', 'ReportsController@reportC');
        Route::get('D', 'ReportsController@reportD');
        Route::get('E', 'ReportsController@reportE');
        Route::get('F', 'ReportsController@reportF');

    });

});