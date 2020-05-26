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

    public function student_faculty($faculty_id = null) {
        $faculty_id == null ? 
            session()->put('faculty_id', null) :
            session()->put('faculty_id', $faculty_id);
        // session()->put('faculty_id', $faculty_id);
        return back();
    }
}
