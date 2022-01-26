<?php

use Illuminate\Support\Facades\Route;

/*
  |--------------------------------------------------------------------------
  | API Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register API routes for your application. These
  | routes are loaded by the RouteServiceProvider within a group which
  | is assigned the "api" middleware group. Enjoy building your API!
  |
 */
Route::get('/', 'App\Http\Controllers\Api\UserController@index')->name('api.index');

Route::prefix('v1')->group(function () {
    Route::get('/', 'App\Http\Controllers\Api\UserController@index')->name('api.v1.index');

    Route::prefix('auth')->group(function () {
        Route::post('/get-token', 'App\Http\Controllers\Api\AuthController@get_token')->name('api.auth.token.index');
    });
    Route::group(['middleware' => 'auth'], function() {
        Route::prefix('user')->group(function () {
            Route::get('/get-list', 'App\Http\Controllers\Api\UserController@get_list')->name('api.user.get_list');
        });
        Route::prefix('product')->group(function () {
            Route::get('/get-list', 'App\Http\Controllers\Api\ProductController@get_list')->name('api.product.get_list');
            Route::get('/get-stock-list', 'App\Http\Controllers\Api\ProductController@get_stock_list')->name('api.product.get_list');
            Route::post('/insert', 'App\Http\Controllers\Api\ProductController@insert')->name('api.product.insert');
            Route::post('/update/{id}', 'App\Http\Controllers\Api\ProductController@update')->name('api.product.update');
            Route::get('/remove/{id}', 'App\Http\Controllers\Api\ProductController@remove')->name('api.product.remove');
            Route::get('/delete/{id}', 'App\Http\Controllers\Api\ProductController@delete')->name('api.product.delete');
        });
        Route::prefix('brand')->group(function () {
            Route::get('/get-list', 'App\Http\Controllers\Api\BrandController@get_list')->name('api.brand.get_list');
        });
        Route::prefix('color')->group(function () {
            Route::get('/get-list', 'App\Http\Controllers\Api\ColorController@get_list')->name('api.color.get_list');
        });
        Route::prefix('gender')->group(function () {
            Route::get('/get-list', 'App\Http\Controllers\Api\GenderController@get_list')->name('api.gender.get_list');
        });
        Route::prefix('size')->group(function () {
            Route::get('/get-list', 'App\Http\Controllers\Api\SizeController@get_list')->name('api.size.get_list');
        });
        Route::prefix('category')->group(function () {
            Route::get('/get-list', 'App\Http\Controllers\Api\CategoryController@get_list')->name('api.category.get_list');
        });
        Route::prefix('cart')->group(function () {
            Route::get('/get-list', 'App\Http\Controllers\Api\CartController@get_list')->name('api.cart.get_list');
            Route::post('/insert', 'App\Http\Controllers\Api\CartController@insert')->name('api.cart.insert');
            Route::post('/update/{id}', 'App\Http\Controllers\Api\CartController@update')->name('api.cart.update');
            Route::get('/remove/{id}', 'App\Http\Controllers\Api\CartController@remove')->name('api.cart.remove');
            Route::get('/delete/{id}', 'App\Http\Controllers\Api\CartController@delete')->name('api.cart.delete');
            Route::post('/checkout', 'App\Http\Controllers\Api\CartController@checkout')->name('api.cart.checkout');
        });
        Route::prefix('shipping-vendor')->group(function () {
            Route::get('/get-list', 'App\Http\Controllers\Api\ShippingVendorController@get_list')->name('api.shipping-vendor.get_list');
        });
    });
});
