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
            toast('Student already registered', 'error');
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
        if ($request->faculty_id == 0 || $request->major_id == 0 || $checkStudentAccount !== null) {
            toast('Invalid update, check your input', 'error');
            return back();
        }
        $std = Student::find($request->studentid);
        $std->name = $request->name;
        $std->faculty_id = $request->faculty_id;
        $std->major_id = $request->major_id;
        $std->born = $request->born;
        $std->birth = $request->birth;
        $std->email = $request->email;
        if ($request->password != null) {
            $std->password = bcrypt($request->password);
        }
        $std->save();
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
        $lct = Lecturer::find($request->lecturerid);
        $lct->name = $request->name;
        $lct->email = $request->email;
        if ($request->password !== null) {
            $lct->password = bcrypt($request->password);
        }
        toast('Lecturer update successfully', 'success');
        $lct->save();
        return back();
    }
}
