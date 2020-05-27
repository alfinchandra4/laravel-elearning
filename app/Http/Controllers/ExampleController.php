<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Response;
use App\Major;
use App\Student;

class ExampleController extends Controller
{
    public function session() {
        dd(session()->all());
    }

    public function test() {
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

    public function getmajor($faculty_id) {
        $data = Major::where('faculty_id', $faculty_id)->get();
        return Response::json([
            'data' => $data
        ]);
    }

    public function getstudent($studentid) {
        $student = Student::find($studentid);
        return Response::json([
            'student' => $student
        ]);
    }
}
