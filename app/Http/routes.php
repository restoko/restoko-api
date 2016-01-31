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

    // Users
    Route::group(['prefix' => 'users'], function() {
        Route::get('/', 'User\UsersController@all');
        Route::post('/', 'User\UsersController@store');
        Route::post('/{userId}','User\UsersController@update');
        Route::post('/{userId}/delete','User\UsersController@destroy');
    });

    // Category
    Route::group(['prefix' => 'categories'], function() {
        Route::get('/', 'Category\CategoriesController@all');
        Route::get('/products', 'Category\CategoriesController@getCategoriesWithProducts');
        Route::post('/', 'Category\CategoriesController@store');
        Route::post('/{categoryId}', 'Category\CategoriesController@update');
        Route::post('/{categoryId}/delete', 'Category\CategoriesController@destroy');
    });

    // Table
    Route::group(['prefix' => 'tables'], function() {
        Route::get('/', 'Table\TablesController@all');
        Route::post('/', 'Table\TablesController@store');
        Route::post('/{tableId}', 'Table\TablesController@update');
        Route::post('/{tableId}/delete', 'Table\TablesController@destroy');
    });

    // Products
    Route::group(['prefix' => 'products'], function() {
        Route::get('/', 'Product\ProductsController@all');
        Route::get('/{productId}', 'Product\ProductsController@getByProductId');
        Route::post('/', 'Product\ProductsController@store');
        Route::post('/{productId}','Product\ProductsController@update');
        Route::post('/{productId}/delete','Product\ProductsController@destroy');
    });

    // Carts
    Route::group(['prefix' => 'carts'], function() {
        Route::get('/{tableId}', 'Pos\CartsController@getCart');
        Route::post('/{tableId}/create', 'Pos\CartsController@createNewCart');
        Route::post('/{cartId}/items', 'Pos\CartItemsController@addItemToCart');
    });
});