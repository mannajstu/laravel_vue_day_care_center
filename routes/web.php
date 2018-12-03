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
Route::resource('classinfo', 'ClassInfoController');

Route::resource('doctorinfo', 'DoctorController');
Route::resource('teacherinfo', 'TeacherController');
Route::resource('examinfo', 'ExamController');

Route::post('notifychildinfo', 'ExamController@notifyinfo');

Route::resource('generalnoticeinfo', 'GeneralNoticeController');
Route::resource('homecontent', 'HomeContentController');
Route::resource('aboutinfo', 'AboutController');
Route::resource('galleryinfo', 'GalleryController');
Route::get('sliderinfo', 'GalleryController@slider');
//message route
Route::resource('admintoparentmsg', 'AdminToParentMsgController');
Route::get('/singleadmintoparentmsg/{id}', 'AdminToParentMsgController@singleadmintoparentmsg');

Route::resource('doctortoparentmsg', 'DoctorToParentMsgController');
Route::get('/singledoctortoparentmsg/{id}', 'DoctorToParentMsgController@singledoctortoparentmsg');
Route::resource('teachertoparentmsg', 'TeacherToParentMsgController');
Route::get('/singleteachertoparentmsg/{id}', 'TeacherToParentMsgController@singleteachertoparentmsg');
Route::resource('parenttoadminmsg', 'ParentToAdminMsgController');
Route::get('/singleparenttoadminmsg/{id}', 'ParentToAdminMsgController@singleparenttoadminmsg');
Route::resource('parenttodoctormsg', 'ParentToDoctorMsgController');
Route::get('/singleparenttodoctormsg/{id}', 'ParentToDoctorMsgController@singleparenttodoctormsg');

Route::resource('parenttoteachermsg', 'ParentToTeacherMsgController');
Route::get('/singleparenttoteachermsg/{id}', 'ParentToTeacherMsgController@singleparenttoteachermsg');

Route::resource('admintodoctormsg', 'AdminToDoctorMsgController');
Route::resource('doctortoadminmsg', 'DoctorToAdminMsgController');


Route::get('{vue_capture?}', 'HomeController@index')->where('vue_capture', '[\/\w\.-]*');