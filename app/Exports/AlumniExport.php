<?php

namespace App\Exports;

use App\Models\AqAnswer;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class AlumniExport implements FromView
{
    public function view(): View
    {
        $answers = AqAnswer::select('alumni_id')->groupBy('alumni_id')->get()->toArray();
        $countalumni = count($answers);
        // Cat 1
        $cat1 = 0; $cat2 = 0; $cat3 = 0;
        foreach ($answers as $key => $val) {
            $alumni_id = $val;
            $cat1 += AqAnswer::where('alumni_id', $alumni_id)->where('aq_category_id', 1)->sum('answer') / 9;
            $cat2 += AqAnswer::where('alumni_id', $alumni_id)->where('aq_category_id', 2)->sum('answer') / 4;
            $cat3 += AqAnswer::where('alumni_id', $alumni_id)->where('aq_category_id', 3)->sum('answer') / 5;
        }

        return view('excel.alumni', [
            'avg_cat1' => $cat1 / $countalumni,
            'avg_cat2' => $cat2 / $countalumni,
            'avg_cat3' => $cat3 / $countalumni,
            'avg'      =>($cat1 / $countalumni + 
                          $cat2 / $countalumni + 
                          $cat3 / $countalumni) / 3
        ]);
    }
}
