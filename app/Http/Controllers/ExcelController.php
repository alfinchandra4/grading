<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\StudentExport;
use App\Exports\AlumniExport;
use App\Exports\LecturerExport;
use Maatwebsite\Excel\Facades\Excel;

class ExcelController extends Controller
{
    public function student_export () {
        return Excel::download(new StudentExport, 'student.xlsx');
    }

    public function alumni_export () {
        return Excel::download(new AlumniExport, 'alumni.xlsx');
    }

    public function lecturer_export () {
        return Excel::download(new LecturerExport, 'lecturer.xlsx');
    }
}
