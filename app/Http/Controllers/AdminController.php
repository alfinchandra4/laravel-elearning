<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Student;
use App\Lecturer;
use Route;


class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    public function student_store(Request $request)
    {
        $isExist = Student::where('nim', $request->nim)->orWhere('email', $request->email)->first();
        if ($isExist) {
            toast('NIM already registered', 'error');
        } else {
            Student::create($request->all());
            toast('Student created!', 'success');
        }
        return back();
    }

    public function student_faculty($faculty_id = null)
    {
        $faculty_id == null ?
            session()->put('faculty_id', null) :
            session()->put('faculty_id', $faculty_id);
        return back();
    }

    public function student_delete($student_id)
    {
        Student::find($student_id)->delete();
        toast('Student removed', 'success');
        return back();
    }

    public function student_update(Request $request)
    {
        $checkStudentAccount = Student::where('email', $request->email)->first();
        if (
            empty($request->faculty_id) ||
            empty($request->major_id) ||
            empty($checkStudentAccount)
        ) {
            toast('Invalid update, check your input', 'error');
            return back();
        }

        $student = Student::findOrFail($request->studentid);
        $request->password == null ?
            $input = $request->except(['password', 'studentid']) :
            $input = $request->except('studentid');
        $student->fill($input)->save();

        toast('Student updated successfully', 'success');
        return back();
    }

    // Lecturer
    public function lecturer()
    {
        return view('admin.lecturer');
    }

    public function lecturer_store(Request $request)
    {
        Lecturer::create($request->all());
        toast('Lecturer created!', 'success');
        return back();
    }

    public function lecturer_delete($lecturer_id)
    {
        Lecturer::find($lecturer_id)->delete();
        toast('Lecturer deleted!', 'success');
        return back();
    }

    public function lecturer_update(Request $request)
    {
        $checkLecturerAccount = Lecturer::find($request->lecturerid);
        if ($checkLecturerAccount->email != $request->email) {
            $checkEmailIsRegisteredAnotherAccount = Lecturer::where('email',  $request->email)->first();
            if ($checkEmailIsRegisteredAnotherAccount !== null) {
                toast('Invalid update, email is exist', 'error');
                return back();
            }
        }
        $lct = Lecturer::findOrFail($request->lecturerid);
        $request->password == null ?
            $input = $request->only(['name', 'email']) :
            $input = $request->only(['name', 'email', 'password']);
        $lct->fill($input)->save();

        toast('Lecturer update successfully', 'success');
        $lct->save();
        return back();
    }
}
