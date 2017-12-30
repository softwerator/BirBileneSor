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

Route::middleware('auth:api')->group(function () {

});

Auth::routes();

Route::post('logout','Auth\LoginController@logout');

Route::prefix('user')->group(function () {

    Route::post('store', 'UserController@store');

    Route::get('show/{id}', 'UserController@show')->where(['id'=>'[0-9]+']);

});

Route::prefix('question')->group(function () {

    Route::post('store', 'QuestionController@store')->middleware('auth');

    Route::get('show/{id}', 'QuestionController@show')->where(['id'=>'[0-9]+']);

});
