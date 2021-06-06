<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            return redirect()->back();
        }
        return view('auth.login');
    }


    public function login(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (!Auth::attempt($credentials)) {

            return back()->withErrors([
                'message' => 'خطأ في أسم المستخدم أو كلمة المرور'
            ]);
        }
        return redirect('/dashboard');
    }

    public function logout()
    {
        auth()->logout();
        return redirect('/login')->with('success', 'You have been logged out');
    }
}
