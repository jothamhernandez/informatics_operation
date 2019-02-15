<?php

use Illuminate\Http\Request;
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

Route::get('/', function (Request $request) {
    // dd($request->server('REMOTE_ADDR'));
    return view('welcome');
});

Route::group(['prefix'=>'admin','middleware'=>['auth','rolecheck']], function(){
    Route::get('/dashboard', 'System\AdminController@dashboard');
    Route::get('/center/{center}', 'System\AdminController@center');
});

Route::group(['prefix'=>'overseer','middleware'=>['auth','rolecheck']], function(){
    Route::get('/dashboard', 'System\OverseerController@dashboard');
});


Route::group(['prefix'=>'center_manager','middleware'=>['auth','rolecheck']], function(){
    Route::get('/dashboard', 'System\CenterManagerController@dashboard');
});


Route::group(['prefix'=>'course_consultant','middleware'=>['auth','rolecheck']], function(){
    Route::get('/dashboard', 'System\CourseConsultantController@dashboard');
});

Route::get('/sandbox', 'Sandbox@testing');

Auth::routes();
Route::get('/forgot-password', 'SystemController@forgotPassword')->middleware('auth')->name('forgotpassword');

Route::get('/home', 'HomeController@index')->name('home');
