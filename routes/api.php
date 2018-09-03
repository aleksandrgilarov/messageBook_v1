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




//Route::resource('messages','MessageController', ['only'=>['index','store']]);
Route::post('messages', 'MessageController@store');
Route::get('messages', 'MessageController@index');
Route::post('upload-image', 'MessageController@uploadPic');





