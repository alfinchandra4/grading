<?php

namespace App\Exports;

use App\Models\SqAnswer;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class StudentExport implements FromView
{

    public function view(): View
    {

        $answers = SqAnswer::select('student_id')->groupBy('student_id')->get()->toArray();
        $countStudent = count($answers);
        // Cat 1
        $cat1 = 0; $cat2 = 0; $cat3 = 0; $cat4 = 0; $cat5 = 0; $cat6 = 0; $cat7 = 0;
        foreach ($answers as $key => $val) {
            $student_id = $val;
            $cat1 += SqAnswer::where('student_id', $student_id)->where('sq_category_id', 1)->sum('answer') / 7;
            $cat2 += SqAnswer::where('student_id', $student_id)->where('sq_category_id', 2)->sum('answer') / 8;
            $cat3 += SqAnswer::where('student_id', $student_id)->where('sq_category_id', 3)->sum('answer') / 6;
            $cat4 += SqAnswer::where('student_id', $student_id)->where('sq_category_id', 4)->sum('answer') / 5;
            $cat5 += SqAnswer::where('student_id', $student_id)->where('sq_category_id', 5)->sum('answer') / 6;
        }

        return view('excel.student', [
            'avg_cat1' => $cat1 / $countStudent,
            'avg_cat2' => $cat2 / $countStudent,
            'avg_cat3' => $cat3 / $countStudent,
            'avg_cat4' => $cat4 / $countStudent,
            'avg_cat5' => $cat5 / $countStudent,


            // Total Keseluruhan
            'avg'      =>($cat1 / $countStudent + 
                          $cat2 / $countStudent + 
                          $cat3 / $countStudent + 
                          $cat4 / $countStudent + 
                          $cat5 / $countStudent ) / 5
        ]);
    }

}
