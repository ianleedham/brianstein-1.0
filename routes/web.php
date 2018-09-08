<?php

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


use Illuminate\Support\Facades\Auth;

Route::get('/', 'PagesController@index');

//Route::get('/vueRouter', function (){return view('vue.vueRouter');});

Route::get('/about', 'PagesController@about')->name('about');

Route::get('/projects', 'PagesController@services');

Route::get('/admin/guest', 'PagesController@guestAdmin')->name('admin-guest');

Route::get('vue-dictionary', 'DictionaryController@vue')->name('vue-dictionary');

Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

Route::get('files/{file} ',  'FilesController@download');

Route::get('/changepassword', 'ChangePasswordController@index');

Route::get('/developer', 'API\UserController@index');

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

Route::get('flashcards', 'DictionaryController@flashCards');
Route::get('multipleChoice', 'quizController@english_cantonese_multiple_choice');
Route::get('reverseMultipleChoice', 'quizController@reverseMultipleChoice');



Route::resource('media', 'FilesController');

Route::post('/changepassword/submit', 'ChangePasswordController@postCredentials');

Route::resource('dictionary', 'DictionaryController');

Route::resource('posts', 'PostsController');

Auth::routes();

Route::post('/send', 'EmailController@send');


