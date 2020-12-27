<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StatsController extends Controller
{

    public function usertype($role) {
        switch ($role) {
            case 1 :

                return view('student.visual._student.all', [
                    'role' => $role
                ]); 
            break;

            case 2 :

                return view('student.visual._lecturer.all', [
                    'role' => $role
                ]); 
            break;

            case 3 : 

                return view('student.visual._alumni.all', [
                    'role' => $role
                ]); 
            break;

        }
    }
}
