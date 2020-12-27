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
        if (Auth::guard('student')->attempt(['nim' => $request->identity, 'password' => $request->password ])) {
            return redirect('/student');
        } elseif (Auth::guard('lecturer')->attempt(['nidn' => $request->identity, 'password' => $request->password ])) {
            return redirect('/lecturer');
        } elseif(Auth::guard('alumni')->attempt(['nim' => $request->identity, 'password' => $request->password ])) {
            return redirect('/alumni');
        }
    }

    public function logout($guard) {
        Auth::guard($guard)->logout();
        return redirect('/');
    }
}
