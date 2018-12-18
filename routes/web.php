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



Auth::routes(['verify' => true]);

Route::get('/', 'HomeController@index')->name('home');
Route::resource('userinfo', 'UserController');
Route::get('/usersearch','UserController@usersearch');

Route::post('/adminActivation', 'UserController@adminActivation');
Route::resource('childinfo', 'ChildInfoController');
Route::resource('parentinfo', 'ParentInfoController');
Route::resource('roominfo', 'RoomController');
Route::get('roomnumber', 'RoomController@roomnumber');
Route::resource('classinfo', 'ClassInfoController');


Route::resource('doctorinfo', 'DoctorController');
Route::resource('teacherinfo', 'TeacherController');
Route::resource('examinfo', 'ExamController');
Route::get('/childexaminfo/{id}', 'ExamController@childexaminfo');


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

Route::get('/singleadmintodoctormsg/{id}', 'AdminToDoctorMsgController@singleadmintodoctormsg');
Route::resource('doctortoadminmsg', 'DoctorToAdminMsgController');
Route::get('/singledoctortoadminmsg/{id}', 'DoctorToAdminMsgController@singledoctortoadminmsg');

Route::resource('teachertoadminmsg', 'TeacherToAdminMsgController');
Route::resource('guesttoadminmsg', 'GuestToAdminMsgController');

Route::resource('admintoteachermsg', 'AdminToTeacherMsgController');
Route::get('/singleadmintoteachermsg/{id}', 'AdminToTeacherMsgController@singleadmintoteachermsg');
Route::get('/singleteachertoadminmsg/{id}', 'TeacherToAdminMsgController@singleteachertoadminmsg');



Route::get('{vue_capture?}', 'HomeController@index')->where('vue_capture', '[\/\w\.-]*');