<?php

namespace App\Http\Controllers;

use App\Models\AqAnswer;
use App\Models\LqAnswer;
use App\Models\SqAnswer;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AcademicsCotroller extends Controller
{
        public function index() {
        session()->put('actor', 1);
        session()->put('visual', 1);
        $routes = [
            'visual.summary',
            'visual.line',
            'visual.bar',
            'visual.detail'
        ];
        session()->put('routes', $routes);
        return redirect()->action(
            [AcademicsCotroller::class, 'actortype'], ['role' => 1]
        );
    }

    public function actortype($role) {
        session()->put('actor', $role);
        session()->put('visual', 1);
        session()->put('dashboard', TRUE);
        return redirect()->action(
            [AcademicsCotroller::class, 'summary'], ['role' => $role]
        );
    }

    // Summary: 1, 2, X
    // Line: 1, X, 3
    // Bar: 1, X, dosen tidak ada
    // Detail: 0

    public function summary ($role) {
        session()->put('visual', 1);
        $defaultPercentage = false;
        switch ($role) {
            // different actor

            case 1:
                    // student
                    $agree = SqAnswer::whereIn('answer', [1, 2])->count();
                    $disagree = SqAnswer::whereIn('answer', [3, 4])->count();
                    if ($agree != 0 && $disagree != 0) {
                        $percentage = [
                            'agree' => ($agree / ($agree + $disagree)) * 100,
                            'disagree' => ($disagree / ($agree + $disagree)) * 100,
                        ];
                    } else {
                        $defaultPercentage = true;
                    }
                break;
            
            case 2:
                // lecturer
                    $agree = LqAnswer::whereIn('answer', [1, 2])->count();
                    $disagree = LqAnswer::whereIn('answer', [3, 4])->count();
                    if ($agree != 0 && $disagree != 0) {
                        $percentage = [
                            'agree' => ($agree / ($agree + $disagree)) * 100,
                            'disagree' => ($disagree / ($agree + $disagree)) * 100,
                        ];
                    } else {
                        $defaultPercentage = true;
                    }
                break;
            
            case 3:
                    $agree = AqAnswer::whereIn('answer', [1, 2])->count();
                    $disagree = AqAnswer::whereIn('answer', [3, 4])->count();
                    if ($agree != 0 && $disagree != 0) {
                        $percentage = [
                            'agree' => ($agree / ($agree + $disagree)) * 100,
                            'disagree' => ($disagree / ($agree + $disagree)) * 100,
                        ];
                    } else {
                        $defaultPercentage = true;
                    }
                break;

        }
        if ($defaultPercentage != true) {
            $percentage = [
                'agree' => number_format((float)($agree / ($agree + $disagree)) * 100, 2, '.', ''),
                'disagree' => number_format((float)($disagree / ($agree + $disagree)) * 100, 2, '.', ''),
            ];
        } else {
            $percentage = [
                'agree' => 50,
                'disagree' => 50,
            ];
        }

        return view('index', [
            'percentage' => $percentage
        ]);
    }

    public function line ($role) {
        session()->put('visual', 2);

        $array = []; 
        $year  = [];
        $count = [];
        switch ($role) {
            case 1:
                $person = 'Mahasiswa';
                $datas = DB::table('sq_answers as sns')->selectRaw('YEAR(sns.created_at) as year, sns.student_id')->distinct()->get()->toArray();
                foreach ($datas as $value) {
                    array_key_exists($value->year, $array) ? 
                        $array[$value->year] += 1 :                         
                        $array[$value->year] = 1;
                }
                foreach ($array as $key => $value) {
                    $year [] = $key; $count [] = $value;
                }
                return view('index', [
                    'years' => json_encode($year),
                    'total' => json_encode($count),
                    'person' => $person,
                ]);
                break;
            
            case 2:
                $person = 'Dosen';
                $datas = DB::table('lq_answers as lns')->selectRaw('YEAR(lns.created_at) as year, lns.lecturer_id')->distinct()->get()->toArray();
                foreach ($datas as $value) {
                    array_key_exists($value->year, $array) ? 
                        $array[$value->year] += 1 :                         
                        $array[$value->year] = 1;
                }
                foreach ($array as $key => $value) {
                    $year [] = $key; $count [] = $value;
                }
                return view('index', [
                    'years' => json_encode($year),
                    'total' => json_encode($count),
                    'person' => $person,
                ]);
                break;

            case 3:
                $person = 'Alumni';
                $datas = DB::table('aq_answers as ans')->selectRaw('YEAR(ans.created_at) as year, ans.alumni_id')->distinct()->get()->toArray();
                foreach ($datas as $value) {
                    array_key_exists($value->year, $array) ? 
                        $array[$value->year] += 1 :                         
                        $array[$value->year] = 1;
                }
                foreach ($array as $key => $value) {
                    $year [] = $key; $count [] = $value;
                }
                return view('index', [
                    'years' => json_encode(array_reverse($year)),
                    'total' => json_encode(array_reverse($count)),
                    'person' => $person,
                ]);
                break;
                
        }

    }

    // Perbandingan
    public function bar ($role) {
        session()->put('visual', 3);

        switch ($role) {
            case 1:
                $studentsWhoAnswers = SqAnswer::select('student_id')->groupBy('student_id')->get()->toArray();
                $studentCollections = Student::whereIn('id', $studentsWhoAnswers)->select(DB::raw("count('major') as total_major"))->groupBy('major')->orderBy('major', 'ASC')->get()->toArray();
                $arrMajor = [];
                foreach ($studentCollections as $value) {
                    $arrMajor [] = $value['total_major'];
                }
                break;

            case 3:
                $text = 'Role 3 bar';
                break;
        }
        return view('index', [
            'data' => json_encode($arrMajor)
        ]);
    }

    public function detail ($role) {
        session()->put('visual', 4);

        switch ($role) {
            case 1:
                $text = 'Role 1 detail';
                break;
            
            case 2:
                $text = 'Role 2 detail';
                break;

            case 3:
                $text = 'Role 3 detail';
                break;
        }
        return view('index', [
            'text' => $text
        ]);
    }
}
