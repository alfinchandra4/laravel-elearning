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
  Route::get('/', 'StudentController@public_lessons')->name('student.public.lessons');
  Route::get('/enroll/{lesson_id}', 'StudentController@public_lessons_enroll')->name('student.public.lesson.enroll');
  Route::get('/lessons/enrolled', 'StudentController@self_lessons_enrolled')->name('student.self.lesson.enrolled');
  Route::get('/lesson/detail/{lesson_id}', 'StudentController@self_lesson_detail')->name('student.self.lesson.detail');

  Route::get('/assignments', 'StudentController@public_assignments')->name('student.public.assignments');
  Route::get('/assignment/detail/{assignment_id}', 'StudentController@public_assignment_detail')->name('student.public.assignment.detail');
  Route::post('/assignment', 'StudentController@public_assignment_store')->name('student.public.assignment.store');
  Route::get('/myassignments', 'StudentController@self_assignments')->name('student.self.assignments');
  Route::get('/myassignment/detail/{assignment_id}', 'StudentController@self_assignment_detail')->name('student.self.assignment.detail');

  // Text update
  Route::post('/myassignment/update/text', 'StudentController@self_assignment_update_text')->name('student.self.assignment.update.text');
  Route::post('/myassignment/update/files', 'StudentController@self_assignment_update_files')->name('student.self.assignment.update.files');
  Route::get('/myassignment/files/delete/{student_assignment_file_id}', 'StudentController@self_assignment_delete_file')->name('student.assignment.files.delete');

  // Quiz
  Route::get('/quiz', 'StudentController@public_quizzes')->name('student.public.quizzes');
  Route::get('/quiz/begin/{quiz_id}', 'StudentController@public_quizzes_detail')->name('student.public.quizzes.detail');
  Route::post('/quiz', 'StudentController@public_quiz_answer')->name('student.public.quizzes.answer');
  Route::get('/quiz/detail/{quiz_id}', 'StudentController@self_quizzes_detail')->name('student.self.quizzes.detail');
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
  Route::get('/assignment/edit/{assignment_id}', 'LecturerController@assignment_edit')->name('lecturer.assignment.edit');
  Route::post('/assignment/update', 'LecturerController@assignment_update')->name('lecturer.assignment.update');
  Route::get('/assignment/detail/{assignment_id?}', 'LecturerController@assignment_detail')->name('lecturer.assignment.detail');
  Route::get('/assignment/student/{student_assignment_id}', 'LecturerController@assignment_student_get')->name('lecturer.assignment.student.get');

  // Kuis
  Route::get('/quiz', 'LecturerController@quiz')->name('lecturer.quiz.index');
  Route::get('/quiz/create', 'LecturerController@quiz_create')->name('lecturer.quiz.create');
  Route::post('/quiz', 'LecturerController@quiz_store')->name('lecturer.quiz.store');
  Route::post('/quiz/update', 'LecturerController@quiz_update')->name('lecturer.quiz.update');
  Route::get('/quiz/delete/{quiz_id}', 'LecturerController@quiz_delete')->name('lecturer.quiz.delete');
  Route::get('/quiz/detail/{quiz_id}', 'LecturerController@quiz_detail')->name('lecturer.quiz.detail');

  Route::get('/quiz/question/{quiz_id}', 'LecturerController@quiz_question_index')->name('lecturer.quiz.question');
  Route::post('/quiz/question', 'LecturerController@quiz_question_store')->name('lecturer.quiz.question.store');
  Route::get('/quiz/question/delete/{question_id}', 'LecturerController@quiz_question_delete')->name('lecturer.quiz.question.delete');

  Route::get('/quiz/students/{quiz_id}', 'LecturerController@quiz_students')->name('lecturer.quiz.student');

  // Live cha (POV: Lecturer)
  Route::get('/chats', 'LecturerController@chats')->name('lecturer.chats');
});

Route::get('/session', 'ExampleController@session');
Route::get('/test', 'ExampleController@test');
Route::get('/getmajor/{faculty_id}', 'ExampleController@getmajor');
Route::get('/getstudent/{student_id}', 'ExampleController@getstudent');
Route::get('/getlecturer/{lecturer_id}', 'ExampleController@getlecturer');
Route::get('/guard', 'ExampleController@guard');
Route::get('/answer', 'ExampleController@answer');
