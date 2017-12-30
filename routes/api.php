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

Route::middleware('cors')->group(function () {

    Auth::routes();

    Route::get('login', 'Auth\LoginController@login');
    Route::get('logout', 'Auth\LoginController@logout');

    Route::prefix('user')->group(function () {

        Route::get('store', 'UserController@store');

        Route::get('show/{id}', 'UserController@show')->where(['id' => '[0-9]+']);

    });

    Route::prefix('question')->group(function () {

        Route::get('paginate', 'QuestionController@paginate');

        Route::get('store', 'QuestionController@store');

        Route::get('show/{id}', 'QuestionController@show')->where(['id' => '[0-9]+']);

        Route::get('answers/{id}', 'QuestionController@answers')->where(['id' => '[0-9]+']);

    });

    Route::prefix('answer')->group(function () {

        Route::get('store', 'AnswerController@store');

    });

});
