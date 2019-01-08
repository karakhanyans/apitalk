<?php

use Illuminate\Http\Request;

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

Route::prefix('store')->group(function () {
    Route::get('/', 'StoreController@index');
    Route::post('/', 'StoreController@create');
    Route::get('/{store}', 'StoreController@show');
    Route::post('/{store}', 'StoreController@edit');
    Route::delete('/{store}', 'StoreController@delete');
});
Route::post('contact', 'ContactMessageController');
Route::get('brands', 'BrandController');
Route::get('timezones', 'TimezoneController');
