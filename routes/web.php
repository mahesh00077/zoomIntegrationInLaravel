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


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
#zoom
Route::get('create/meeting', 'Admin\ZoomController@index');
Route::post('create/meeting/add', 'Admin\ZoomController@add');
Route::get('delete/meeting/{id}', 'Admin\ZoomController@remove');
Route::get('meeting/start/{id}', 'Admin\ZoomController@startMeeting');
Route::get('join/meeting', 'Admin\ZoomController@joinMeeting');