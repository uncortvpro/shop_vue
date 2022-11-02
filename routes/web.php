<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/','\App\Http\Controllers\MainController@index');
Route::get('/product/list','\App\Http\Controllers\ProductController@list');


Route::get('/category/list','\App\Http\Controllers\Categories\CategoryController@list');
Route::get('/category/show/{id}','\App\Http\Controllers\Categories\CategoryController@show');
Route::get('/category/action','\App\Http\Controllers\Categories\CategoryController@action');
Route::get('/category/action/{id}','\App\Http\Controllers\Categories\CategoryController@action');
Route::post('/category/create','\App\Http\Controllers\Categories\CategoryController@create');
Route::post('/category/update/{id}','\App\Http\Controllers\Categories\CategoryController@update');
Route::get('/category/delete/{id}','\App\Http\Controllers\Categories\CategoryController@delete');


Route::post('/category/variation/add/{category_id}/{variation_id}','\App\Http\Controllers\Categories\VariationController@add');
Route::post('/category/variation/update/{category_id}/{variation_id}','\App\Http\Controllers\Categories\VariationController@update');
Route::get('/category/variation/delete/{category_id}/{variation_id}','\App\Http\Controllers\Categories\VariationController@delete');
Route::get('/category/variation/get/{category_id}/{variation_id}','\App\Http\Controllers\Categories\VariationController@get');
Route::get('/category/variation/first/{variation_id}','\App\Http\Controllers\Categories\VariationController@getVariationById');


Route::post('/category/characteristic/add/{category_id}','\App\Http\Controllers\Categories\CharacteristicController@add');
Route::post('/category/characteristic/update/{category_id}/{characteristic_id}','\App\Http\Controllers\Categories\CharacteristicController@update');
Route::get('/category/characteristic/delete/{category_id}/{characteristic_id}','\App\Http\Controllers\Categories\CharacteristicController@delete');

Route::post('/category/brand/add/{category_id}','\App\Http\Controllers\Categories\BrandController@add');
Route::post('/category/brand/update/{category_id}/{brand_id}','\App\Http\Controllers\Categories\BrandController@update');
Route::get('/category/brand/delete/{category_id}/{brand_id}','\App\Http\Controllers\Categories\BrandController@delete');




Route::get('/product/list','\App\Http\Controllers\ProductController@list');
Route::get('/product/show/{id}','\App\Http\Controllers\ProductController@show');
Route::get('/product/action','\App\Http\Controllers\ProductController@action');
Route::post('/product/create','\App\Http\Controllers\ProductController@create');
