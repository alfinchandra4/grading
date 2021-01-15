<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login() {
        return view('login');
    }

    public function attempt(Request $request) {

        session()->forget('questions');
        session()->forget('forms');

        if (Auth::guard('student')->attempt(['nim' => $request->identity, 'password' => $request->password ])) {
            return redirect('/dashboard');
        } elseif (Auth::guard('lecturer')->attempt(['nidn' => $request->identity, 'password' => $request->password ])) {
            return redirect('/dashboard');
        } elseif(Auth::guard('alumni')->attempt(['nim' => $request->identity, 'password' => $request->password ])) {
            return redirect('/dashboard');
        } elseif(Auth::guard('dean')->attempt(['email' => $request->identity, 'password' => $request->password ])) {
            return redirect('/dashboard');
        } elseif(Auth::guard('administrator')->attempt(['email' => $request->identity, 'password' => $request->password ])) {
            return redirect('/dashboard');
        }
            return back()->withError('Invalid Credentials');
    }

    public function logout($guard) {
        Auth::guard($guard)->logout();
        return redirect('/');
    }
}
