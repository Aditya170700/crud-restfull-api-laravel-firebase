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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('firebase', 'FirebaseController@index')->name('firebase');
Route::post('firebase','FirebaseController@create')->name('firebase.create');
Route::put('firebase/{id}', 'FirebaseController@update')->name('firebase.update');
Route::get('firebase/{id}', 'FirebaseController@show')->name('firebase.show');
Route::delete('firebase/{id}', 'FirebaseController@delete')->name('firebase.delete');