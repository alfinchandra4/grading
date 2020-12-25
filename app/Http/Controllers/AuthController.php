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
        $credential = [
            'identity' => $request->identity,
            'password' => $request->password
        ];
        if (Auth::guard('student')->attempt($credential)) {
            return redirect('/student');
        }
    }

    public function logout($guard) {
        Auth::guard($guard)->logout();
        return redirect('/');
    }
}
