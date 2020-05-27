<?php

use Illuminate\Support\Facades\Route;

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
Route::view('/', 'login');
Route::post('/login', 'LoginController@login');
Route::get('/logout', 'LoginController@logout');

Route::group(['prefix' => 'admin', 'middleware' => ['auth:admin']], function () {
  // Student page
  Route::get('/', 'AdminController@index')->name('admin.index');
  Route::post('/student', 'AdminController@student_store')->name('admin.student.store');
  Route::get('/student/delete/{student_id}', 'AdminController@student_delete')->name('admin.student.delete');
  Route::get('/student/edit/{student_id}'. 'AdminController@student_edit')->name('admin.student.edit');
  Route::post('/student/update', 'AdminController@student_update')->name('admin.student.update');
  Route::get('/faculty/{faculty_id?}', 'AdminController@student_faculty')->name('admin.student.faculty');


  // Lecturer page
  Route::get('/lecturer', 'AdminController@lecturer')->name('admin.lecturer');
  Route::post('/lecturer', 'AdminController@lecturer_store')->name('admin.lecturer.store');
  Route::get('/lecturer/edit/{lecturer_id}', 'AdminController@lecturer_edit')->name('admin.lecturer.edit');
  Route::get('/lecturer/delete/{lecturer_id}', 'AdminController@lecturer_delete')->name('admin.lecturer.delete');
  Route::post('/lecturer/update', 'AdminController@lecturer_update')->name('admin.lecturer.update');

});

Route::group(['prefix' => 'student', 'middleware' => ['auth:student']], function () {
  Route::view('/home', 'student.index')->name('student.index');
});

Route::group(['prefix' => 'lecturer', 'middleware' => ['auth:lecturer']], function () {
  Route::view('/home', 'lecturer.index')->name('lecturer.index');
});

Route::get('/session', 'ExampleController@session');
Route::get('/test', 'ExampleController@test');
Route::get('/getmajor/{faculty_id}', 'ExampleController@getmajor');
Route::get('/getstudent/{student_id}', 'ExampleController@getstudent');
Route::get('/getlecturer/{lecturer_id}', 'ExampleController@getlecturer');