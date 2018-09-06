<?php

use Illuminate\Http\Request;

Route::post('messages', 'MessageController@store');
Route::get('messages', 'MessageController@index');
Route::post('upload-image', 'MessageController@uploadPic');





