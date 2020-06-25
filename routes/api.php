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


Route::get('/brands', 'BrandController@index');
Route::post('/brands', 'BrandController@store');
Route::get('/brands/{id}', 'BrandController@show');
Route::post('/brands/{id}', 'BrandController@delete');
Route::get('/products', 'ProductController@index');
Route::get('/products/{id}', 'ProductController@show');
Route::get('/news', 'ActuController@index');
Route::get('/news/latest', 'ActuController@lastNews');
Route::get('/news/{id}', 'ActuController@show');
Route::post('/contact', 'ContactController@sendMail');
Route::post('/order', 'OrderController@store');


