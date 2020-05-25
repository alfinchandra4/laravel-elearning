<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $credential = ['email' => $request->email, 'password' => $request->password];

        if (auth()->guard('admin')->attempt($credential)) {
            return redirect()->intended('/admin/home');
        } elseif (auth()->guard('student')->attempt($credential)) {
            return redirect()->intended('/student/home');
        } elseif (auth()->guard('lecturer')->attempt($credential)) {
            return redirect()->intended('/lecturer/home');
        } else {
            return back()->withError('Invalid credentials!');
        }
    }

    public function logout()
    {
        if (auth()->guard('admin')->check()) {
            auth()->guard('admin')->logout();
        } elseif (auth()->guard('student')->check()) {
            auth()->guard('student')->logout();
        } elseif (auth()->guard('lecturer')->check()) {
            auth()->guard('lecturer')->logoout();
        }

        return redirect('/');
    }
}
