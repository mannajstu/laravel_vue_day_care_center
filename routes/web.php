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



Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::resource('userinfo', 'UserController');
Route::post('/adminActivation', 'UserController@adminActivation');
Route::resource('childinfo', 'ChildInfoController');
Route::resource('parentinfo', 'ParentInfoController');
Route::resource('roominfo', 'RoomController');

Route::resource('doctorinfo', 'DoctorController');
Route::resource('teacherinfo', 'TeacherController');


Route::get('{vue_capture?}', 'HomeController@index')->where('vue_capture', '[\/\w\.-]*');