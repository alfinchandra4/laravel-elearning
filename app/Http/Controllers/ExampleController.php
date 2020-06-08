<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Response;
use App\Major;
use App\Student;
use App\Lecturer;

class ExampleController extends Controller
{
    public function session()
    {
        dd(session()->all());
        // session()->forget('student_assignment_files');
    }

    public function test()
    {
        $arrFaculty = [
            ['FEB', 'Ekonomi dan Bisnis'],
            ['FK', 'Kedokteran'],
            ['FT', 'Teknik'],
            ['FISIP', 'Ilmu Sosial'],
            ['FIK', 'Ilmu Komputer'],
            ['FH', 'Hukum'],
            ['FIKES', 'Ilmu Kesehatan']
        ];
        dd($arrFaculty[0][1]);
    }

    public function getmajor($faculty_id)
    {
        $data = Major::where('faculty_id', $faculty_id)->get();
        return Response::json([
            'data' => $data
        ]);
    }

    public function getstudent($studentid)
    {
        $student = Student::find($studentid);
        return Response::json([
            'student' => $student
        ]);
    }

    public function getLecturer($lecturer_id)
    {
        $lecturer = Lecturer::find($lecturer_id);
        return Response::json([
            'lecturer' => $lecturer
        ]);
    }

    public function guard()
    {
        return student()->name;
    }

    public function answer()
    {
        session()->forget('arrQuestionAnswers');
        session()->forget('student');
        session()->forget('student_choices');
        session()->forget('lecturers');
        session()->forget('user_chats');
    }

    public function logindebug() {
        $user = Student::find(1);
        dd($user);
    }
}
