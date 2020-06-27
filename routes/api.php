<?php

use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['auth:sanctum', ])->group(function () {
    Route::post('/brands', 'BrandController@store');
    Route::post('/brands/update/{id}', 'BrandController@update');
    Route::delete('/brands/{id}', 'BrandController@delete');
    Route::post('/products', 'ProductController@store');
    Route::delete('/products/image/{id}', 'ImageController@delete');
    Route::post('/products/update/{id}', 'ProductController@update');
    Route::delete('/products/{id}', 'ProductController@delete');
    Route::post('/news', 'ActuController@store');
    Route::post('/news/{id}', 'ActuController@update');
    Route::delete('/news/{id}', 'ActuController@delete');
});



Route::get('/brands', 'BrandController@index');
Route::get('/brands/{id}', 'BrandController@show');
Route::get('/products', 'ProductController@index');
Route::get('/products/{id}', 'ProductController@show');
Route::get('/news', 'ActuController@index');
Route::get('/news/latest', 'ActuController@lastNews');
Route::get('/news/{id}', 'ActuController@show');
Route::post('/contact', 'ContactController@sendMail');
Route::post('/order', 'OrderController@store');


