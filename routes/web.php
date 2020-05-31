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
  Route::get('/student/edit/{student_id}' . 'AdminController@student_edit')->name('admin.student.edit');
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

  //  Materi
  Route::get('/', 'LecturerController@index')->name('lecturer.index');
  Route::get('/lesson/create', 'LecturerController@lesson_create')->name('lecturer.lesson.create');
  Route::post('/lesson/store', 'LecturerController@lesson_store')->name('lecturer.lesson.store');
  Route::get('/lesson/edit/{lesson_id}', 'LecturerController@lesson_edit')->name('lecturer.lesson.edit');
  Route::post('/lesson/update', 'LecturerController@lesson_update')->name('lecturer.lesson.update');
  Route::get('/lesson/delete/{lesson_id}', 'LecturerController@lesson_delete')->name('lecturer.lesson.delete');
  Route::get('/lesson/file/{lessonfile_id}/delete', 'LecturerController@lessonfile_delete')->name('lecturer.lessons.files.delete');
  Route::post('/lesson/file/upload', 'LecturerController@lessonfile_upload')->name('lecturer.lessons.files.store');

  //  Assignments
  Route::get('/assignment', 'LecturerController@assignment')->name('lecturer.assignment.index');
  Route::get('/assignment/create', 'LecturerController@assignment_create')->name('lecturer.assignment.create');
  Route::post('/assignment', 'LecturerController@assignment_store')->name('lecturer.assignment.store');
  Route::get('/assignment/detail/{assignment_id?}', 'LecturerController@assignment_detail')->name('lecturer.assignment.detail');

  // Kuis
  Route::get('/quiz', 'LecturerController@quiz')->name('lecturer.quiz.index');
  Route::get('/quiz/create', 'LecturerController@quiz_create')->name('lecturer.quiz.create');
  Route::post('/quiz', 'LecturerController@quiz_store')->name('lecturer.quiz.store');
  Route::post('/quiz/update', 'LecturerController@quiz_update')->name('lecturer.quiz.update');
  Route::get('/quiz/detail/{quiz_id}', 'LecturerController@quiz_detail')->name('lecturer.quiz.detail');

  Route::get('/quiz/question/{quiz_id}', 'LecturerController@quiz_question_index')->name('lecturer.quiz.question');
  Route::post('/quiz/question', 'LecturerController@quiz_question_store')->name('lecturer.quiz.question.store');
  Route::get('/quiz/question/delete/{question_id}', 'LecturerController@quiz_question_delete')->name('lecturer.quiz.question.delete');

  Route::get('/quiz/students/{quiz_id}', 'LecturerController@quiz_students')->name('lecturer.quiz.student');

});

Route::get('/session', 'ExampleController@session');
Route::get('/test', 'ExampleController@test');
Route::get('/getmajor/{faculty_id}', 'ExampleController@getmajor');
Route::get('/getstudent/{student_id}', 'ExampleController@getstudent');
Route::get('/getlecturer/{lecturer_id}', 'ExampleController@getlecturer');
