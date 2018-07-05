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


Route::group(['prefix' => 'v1', 'middleware' => 'auth:api'], function(){


});


Route::get('/dictionary', 'DictionaryApiController@index');

Route::get('/whole-dictionary', 'DictionaryApiController@whole')->middleware('auth:api');

//list single word
Route::get('dictionary/{id}', 'DictionaryApiController@show');

//Create new word
Route::post('dictionary', 'DictionaryApiController@store');//->middleware('auth:api');

//update word
Route::put('dictionary', 'DictionaryApiController@store')->middleware('auth:api');

//Delete word
Route::delete('dictionary/{id}', 'DictionaryApiController@destroy')->middleware('auth:api');

//login and get 0auth token
Route::post('login', 'API\UserController@login');

//register for app
Route::post('register', 'API\UserController@register');


Route::group(['middleware' => 'auth:api'], function(){

    Route::post('details', 'API\UserController@details');

});


