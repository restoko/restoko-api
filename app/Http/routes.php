<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

/*
|-------------------------------------------------------------------------
| API V1 Routes
|-------------------------------------------------------------------------
| This is the service or API routes for version 1
|
*/
Route::group(['prefix' => 'api/v1/'], function() {
    // Auth
    Route::group(['prefix' => 'o/auth'], function() {
        Route::post('/', 'Auth\AuthController@auth');
        Route::post('/me', 'Auth\AuthController@info');
    });

    // Category
    Route::group(['prefix' => 'categories'], function() {
        Route::get('/', 'Category\CategoriesController@all');
        Route::post('/', 'Category\CategoriesController@store');
        Route::post('/{categoryId}', 'Category\CategoriesController@update');
        Route::post('/{categoryId}/delete', 'Category\CategoriesController@destroy');
    });

    // Products
    Route::group(['prefix' => 'products'], function() {
        Route::get('/', 'Product\ProductsController@all');
    });

});