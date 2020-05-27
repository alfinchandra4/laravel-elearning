<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Student;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    public function student_store(Request $request)
    {
        $isExist = Student::where('nim', $request->nim)->first();
        if ($isExist) {
            toast('Student already registered', 'error');
        } else {
            Student::create([
                'nim' => $request->nim,
                'name' => $request->name,
                'faculty_id' => $request->faculty_id,
                'major_id' => $request->major_id,
                'born' => $request->born,
                'birth' => $request->birth,
                'email' => $request->email,
                'password' => bcrypt($request->password),
            ]);
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
        if($request->faculty_id == 0 || $request->major_id == 0) {
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
        if ($request->password != null ) {
            $std->password = bcrypt($request->password);
        }
        $std->save();
        toast('Student updated successfully', 'success');
        return back();
    }
}
