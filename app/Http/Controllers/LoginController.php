<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Alert;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $credential = ['email' => $request->email, 'password' => $request->password];

        if (Auth::guard('admin')->attempt($credential)) {
            return redirect()->intended('/admin');
        } elseif (Auth::guard('student')->attempt($credential)) {
            return redirect()->intended('/student');
        } elseif (Auth::guard('lecturer')->attempt($credential)) {
            return redirect()->intended('/lecturer');
        } else {
            return back()->withError('Error! Invalid Credentials');
        }
    }

    public function logout()
    {
        if (auth()->guard('admin')->check()) {
            auth()->guard('admin')->logout();
        } elseif (auth()->guard('student')->check()) {
            auth()->guard('student')->logout();
        } elseif (auth()->guard('lecturer')->check()) {
            auth()->guard('lecturer')->logout();
        }

        return redirect('/');
    }
}
