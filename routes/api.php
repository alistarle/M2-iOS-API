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
Route::post("register", 'UserController@register'); //Done

Route::group(["middleware" => 'auth:api'], function() {
    Route::get("user", "UserController@profile"); //Done
    Route::get("user/board", "UserController@board"); //Done
    Route::patch("user", "UserController@update"); //Done
    Route::get("user/{user}", "UserController@profile"); //Done
    Route::get("user/{user}/board", "UserController@board"); //Done
    Route::patch("user/{user}/rate", "UserController@rate"); //Done

    Route::post("session", "SessionController@create"); //Done
    Route::get("match/{session}", "SessionController@match");
    Route::patch("session/{session}", "SessionController@update"); //Done
});
