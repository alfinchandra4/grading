<?php

namespace App\Exports;

use App\Models\LqAnswer;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class LecturerExport implements FromView
{
    public function view(): View
    {
        $answers = LqAnswer::select('lecturer_id')->groupBy('lecturer_id')->get()->toArray();
        $countlecturer = count($answers);
        // Cat 1
        $cat1 = 0; $cat2 = 0; $cat3 = 0; $cat4 = 0; $cat5 = 0; $cat6 = 0; $cat7 = 0; $cat8 = 0;
        foreach ($answers as $key => $val) {
            $lecturer_id = $val;
            $cat1 += LqAnswer::where('lecturer_id', $lecturer_id)->where('lq_category_id', 1)->sum('answer') / 6;
            $cat2 += LqAnswer::where('lecturer_id', $lecturer_id)->where('lq_category_id', 2)->sum('answer') / 7;
            $cat3 += LqAnswer::where('lecturer_id', $lecturer_id)->where('lq_category_id', 3)->sum('answer') / 9;
            $cat4 += LqAnswer::where('lecturer_id', $lecturer_id)->where('lq_category_id', 4)->sum('answer') / 7;
            $cat5 += LqAnswer::where('lecturer_id', $lecturer_id)->where('lq_category_id', 5)->sum('answer') / 6;
            $cat6 += LqAnswer::where('lecturer_id', $lecturer_id)->where('lq_category_id', 6)->sum('answer') / 3;
            $cat7 += LqAnswer::where('lecturer_id', $lecturer_id)->where('lq_category_id', 7)->sum('answer') / 3;
            $cat8 += LqAnswer::where('lecturer_id', $lecturer_id)->where('lq_category_id', 8)->sum('answer') / 3;
        }

        return view('excel.lecturer', [
            'avg_cat1' => $cat1 / $countlecturer,
            'avg_cat2' => $cat2 / $countlecturer,
            'avg_cat3' => $cat3 / $countlecturer,
            'avg_cat4' => $cat4 / $countlecturer,
            'avg_cat5' => $cat5 / $countlecturer,
            'avg_cat6' => $cat6 / $countlecturer,
            'avg_cat7' => $cat7 / $countlecturer,
            'avg_cat8' => $cat8 / $countlecturer,
            'avg'      =>($cat1 / $countlecturer + 
                          $cat2 / $countlecturer + 
                          $cat3 / $countlecturer +
                          $cat4 / $countlecturer +
                          $cat5 / $countlecturer +
                          $cat6 / $countlecturer +
                          $cat7 / $countlecturer +
                          $cat8 / $countlecturer
                          ) / 8
        ]);
    }
}
