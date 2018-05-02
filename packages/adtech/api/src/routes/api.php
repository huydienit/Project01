<?php

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

Route::group(array('prefix' => 'auth'), function () {
    Route::post('login', 'Auth\LoginController@login');

    Route::middleware('jwt.auth')->get('verify', 'Auth\LoginController@verify');

    Route::middleware('jwt.auth')->post('register', 'Auth\RegisterController@create');
});