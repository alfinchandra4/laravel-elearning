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
  Route::view('/home', 'admin.index')->name('admin.index');
});

Route::group(['prefix' => 'student', 'middleware' => ['auth:student']], function () {
  Route::view('/home', 'student.index')->name('student.index');
});

Route::group(['prefix' => 'lecturer', 'middleware' => ['auth:lecturer']], function () {
  Route::view('/home', 'lecturer.index')->name('lecturer.index');
});

Route::get('/session', 'ExampleController@session');