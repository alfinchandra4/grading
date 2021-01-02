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
            return redirect('/dashboard');
        } elseif (Auth::guard('lecturer')->attempt(['nidn' => $request->identity, 'password' => $request->password ])) {
            return redirect('/dashboard');
        } elseif(Auth::guard('alumni')->attempt(['nim' => $request->identity, 'password' => $request->password ])) {
            return redirect('/dashboard');
        }
    }

    public function logout($guard) {
        Auth::guard($guard)->logout();
        return redirect('/');
    }
}
