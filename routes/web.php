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

Route::get('/about', 'PagesController@about')->name('about');

Route::get('/projects', 'PagesController@services');

Route::get('/admin/guest', 'PagesController@guestAdmin')->name('admin-guest');

Route::get('vue-dictionary', 'DictionaryController@vue')->name('vue-dictionary');

Route::resource('dictionary', 'DictionaryController');

Route::resource('posts', 'PostsController');

Auth::routes();

Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

Route::get('files/{file} ',  'FilesController@download');

Route::get('media/guest',  'FilesController@GuestPMS')->name('media-guest');

Route::resource('media', 'FilesController');

Route::get('/changepassword', 'ChangePasswordController@index');

//Route::get('/video', function (){return view('video');});

//Route::get('/audio', function (){return view('soundrecorder');});

Route::post('/changepassword/submit', 'ChangePasswordController@postCredentials');


Auth::routes();



/*Route::get('/admin',[
    'uses' => 'AppController@getAdminPage',
    'as'=>'admin',
    'middleware' => 'roles',
    'roles' => ['Admin']
]);
Route::post('/admin/assign-roles',[
    'uses' => 'AppController@postAdminAssignRoles',
    'as'=>'admin.assign',
]);*/

Route::post('/recording', ['as' => 'post.recording', 'uses' => 'RecordingController@postRecording']);

Route::get('/recording/{id}', ['as' => 'get.recording', 'uses' => 'RecordingController@getRecording']);

Route::post('/send', 'EmailController@send');

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
