<?php

namespace App\Http\Controllers;

use App\Models\Alumni;
use App\Models\AqAnswer;
use App\Models\LqAnswer;
use App\Models\Report;
use App\Models\SqAnswer;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

                // Si
                $siStudents = Student::whereIn('id', $studentsWhoAnswers)->where('major', 1)->select('id')->get()->toArray();
                $siStudentAmount = Student::whereIn('id', $studentsWhoAnswers)->where('major', 1)->count();
                $siStudentAverage = 0;
                foreach ($siStudents as $key => $std) {
                    $student_answered = SqAnswer::where('student_id', $std);
                    $answer_c1 = $student_answered->where('sq_category_id', 1)->sum('answer') / 7;
                    $answer_c2 = $student_answered->where('sq_category_id', 2)->sum('answer') / 8;
                    $answer_c3 = $student_answered->where('sq_category_id', 3)->sum('answer') / 6;
                    $answer_c4 = $student_answered->where('sq_category_id', 4)->sum('answer') / 5;
                    $answer_c5 = $student_answered->where('sq_category_id', 5)->sum('answer') / 6;
                    $siStudentAverage += (($answer_c1 + $answer_c2 + $answer_c3 + $answer_c4 + $answer_c5) / 5);
                }
                $siStudentAverage == 0 ? $finalSi = 0 : $finalSi = ($siStudentAverage * 100) / $siStudentAmount;

                // Ti
                $tiStudents = Student::whereIn('id', $studentsWhoAnswers)->where('major', 2)->select('id')->get()->toArray();
                $tiStudentAmount = Student::whereIn('id', $studentsWhoAnswers)->where('major', 2)->count();
                $tiStudentAverage = 0;
                foreach ($tiStudents as $key => $std) {
                    $student_answered = SqAnswer::where('student_id', $std);
                    $answer_c1 = $student_answered->where('sq_category_id', 1)->sum('answer') / 7;
                    $answer_c2 = $student_answered->where('sq_category_id', 2)->sum('answer') / 8;
                    $answer_c3 = $student_answered->where('sq_category_id', 3)->sum('answer') / 6;
                    $answer_c4 = $student_answered->where('sq_category_id', 4)->sum('answer') / 5;
                    $answer_c5 = $student_answered->where('sq_category_id', 5)->sum('answer') / 6;
                    $tiStudentAverage += (($answer_c1 + $answer_c2 + $answer_c3 + $answer_c4 + $answer_c5) / 5);
                }
                $tiStudentAverage == 0 ? $finalTi = 0 :  $finalTi = ($tiStudentAverage * 100) / $tiStudentAmount;

                //
                $miStudents = Student::whereIn('id', $studentsWhoAnswers)->where('major', 3)->select('id')->get()->toArray();
                $miStudentAmount = Student::whereIn('id', $studentsWhoAnswers)->where('major', 3)->count();
                $miStudentAverage = 0;
                foreach ($miStudents as $key => $std) {
                    $student_answered = SqAnswer::where('student_id', $std);
                    $answer_c1 = $student_answered->where('sq_category_id', 1)->sum('answer') / 7;
                    $answer_c2 = $student_answered->where('sq_category_id', 2)->sum('answer') / 8;
                    $answer_c3 = $student_answered->where('sq_category_id', 3)->sum('answer') / 6;
                    $answer_c4 = $student_answered->where('sq_category_id', 4)->sum('answer') / 5;
                    $answer_c5 = $student_answered->where('sq_category_id', 5)->sum('answer') / 6;
                    $miStudentAverage += (($answer_c1 + $answer_c2 + $answer_c3 + $answer_c4 + $answer_c5) / 5);
                }
                $miStudentAverage == 0 ? $finalMi = 0 : $finalMi = ($miStudentAverage * 100) / $miStudentAmount;

                $data = [(int) $finalSi, (int) $finalTi, (int)$finalMi];
                // dd($data);
            case 3:
                $studentsWhoAnswers = AqAnswer::select('alumni_id')->groupBy('alumni_id')->get()->toArray();

                // Si
                $siStudents = Alumni::whereIn('id', $studentsWhoAnswers)->where('major', 1)->select('id')->get()->toArray();
                $siStudentAmount = Alumni::whereIn('id', $studentsWhoAnswers)->where('major', 1)->count();
                $siStudentAverage = 0;
                foreach ($siStudents as $key => $std) {
                    $student_answered = AqAnswer::where('alumni_id', $std);
                    $answer_c1 = $student_answered->where('aq_category_id', 1)->sum('answer') / 4;
                    $answer_c2 = $student_answered->where('aq_category_id', 2)->sum('answer') / 2;
                    $answer_c3 = $student_answered->where('aq_category_id', 3)->sum('answer') / 2;
                    $answer_c4 = $student_answered->where('aq_category_id', 4)->sum('answer') / 7;
                    $answer_c5 = $student_answered->where('aq_category_id', 5)->sum('answer') / 6;
                    $siStudentAverage += (($answer_c1 + $answer_c2 + $answer_c3 + $answer_c4 + $answer_c5) / 5);
                }
                $siStudentAverage == 0 ? $finalSi = 0 : $finalSi = ($siStudentAverage * 100) / $siStudentAmount;

                // Ti
                $tiStudents = Alumni::whereIn('id', $studentsWhoAnswers)->where('major', 2)->select('id')->get()->toArray();
                $tiStudentAmount = Alumni::whereIn('id', $studentsWhoAnswers)->where('major', 2)->count();
                $tiStudentAverage = 0;
                foreach ($tiStudents as $key => $std) {
                    $student_answered = AqAnswer::where('alumni_id', $std);
                    $answer_c1 = $student_answered->where('aq_category_id', 1)->sum('answer') / 4;
                    $answer_c2 = $student_answered->where('aq_category_id', 2)->sum('answer') / 2;
                    $answer_c3 = $student_answered->where('aq_category_id', 3)->sum('answer') / 2;
                    $answer_c4 = $student_answered->where('aq_category_id', 4)->sum('answer') / 7;
                    $answer_c5 = $student_answered->where('aq_category_id', 5)->sum('answer') / 6;
                    $tiStudentAverage += (($answer_c1 + $answer_c2 + $answer_c3 + $answer_c4 + $answer_c5) / 5);
                }
                $tiStudentAverage == 0 ? $finalTi = 0 :  $finalTi = ($tiStudentAverage * 100) / $tiStudentAmount;

                //
                $miStudents = Alumni::whereIn('id', $studentsWhoAnswers)->where('major', 3)->select('id')->get()->toArray();
                $miStudentAmount = Alumni::whereIn('id', $studentsWhoAnswers)->where('major', 3)->count();
                $miStudentAverage = 0;
                foreach ($miStudents as $key => $std) {
                    $answer_c1 = AqAnswer::where('alumni_id', $std)->where('aq_category_id', 1)->sum('answer') / 4;
                    $answer_c2 = AqAnswer::where('alumni_id', $std)->where('aq_category_id', 2)->sum('answer') / 2;
                    $answer_c3 = AqAnswer::where('alumni_id', $std)->where('aq_category_id', 3)->sum('answer') / 2;
                    $answer_c4 = AqAnswer::where('alumni_id', $std)->where('aq_category_id', 4)->sum('answer') / 7;
                    $answer_c5 = AqAnswer::where('alumni_id', $std)->where('aq_category_id', 5)->sum('answer') / 6;
                    $miStudentAverage += (($answer_c1 + $answer_c2 + $answer_c3 + $answer_c4 + $answer_c5) / 5);
                }
                $miStudentAverage == 0 ? $finalMi = 0 : $finalMi = ($miStudentAverage * 100) / $miStudentAmount;

                $data = [(int) $finalSi, (int) $finalTi, (int)$finalMi];
                break;
        }
        return view('index', [
            'data' => json_encode($data)
        ]);
    }

    public function detail ($role) {
        session()->put('visual', 4);

        switch ($role) {
            case 1: 
                $studentsWhoAnswers = SqAnswer::select('student_id')->groupBy('student_id')->get()->toArray();
                $studentLength = count($studentsWhoAnswers);
                $categories = ['Tangibles', 'Reliability', 'Responsiveness', 'Assurance', 'Empathy'];
                $cat1= 0; $cat2 = 0; $cat3 = 0; $cat4 = 0; $cat5 = 0;

                foreach ($studentsWhoAnswers as $key => $std) {
                    $cat1 += SqAnswer::where('student_id', $std)->where('sq_category_id', 1)->sum('answer') / 7;
                    $cat2 += SqAnswer::where('student_id', $std)->where('sq_category_id', 2)->sum('answer') / 8;
                    $cat3 += SqAnswer::where('student_id', $std)->where('sq_category_id', 3)->sum('answer') / 6;
                    $cat4 += SqAnswer::where('student_id', $std)->where('sq_category_id', 4)->sum('answer') / 5;
                    $cat5 += SqAnswer::where('student_id', $std)->where('sq_category_id', 5)->sum('answer') / 6;
                }

                    $cat1 == 0 ? $cat1 = 0 : $cat1 /= $studentLength;
                    $cat2 == 0 ? $cat2 = 0 : $cat2 /= $studentLength;
                    $cat3 == 0 ? $cat3 = 0 : $cat3 /= $studentLength;
                    $cat4 == 0 ? $cat4 = 0 : $cat4 /= $studentLength;
                    $cat5 == 0 ? $cat5 = 0 : $cat5 /= $studentLength;
                    
                $max   = [(int) $cat1, (int) $cat2, (int) $cat3, (int) $cat4, (int) $cat5];
                $color = ['#ff7b54', '#ff7b54', '#ff7b54', '#ff7b54', '#ff7b54'];
                break;
            
            case 2:
                $lecturerWhoAnswers = LqAnswer::select('lecturer_id')->groupBy('lecturer_id')->get()->toArray();
                $studentLength = count($lecturerWhoAnswers);
                $categories = [
                    'Pengembangan Kompetensi', 
                    'Pengembangan Karir / Jabatan', 
                    'Penelitian dan Karya Ilmiah', 
                    'Pengabdian Kepada Masyarakat',
                    'Tugas Tambahan',
                    'Kebutuhan Kesejahteraan',
                    'Kebutuhan Kesehatan dan Kebugaran',
                    'Pengabdian Kepada Masyarakat'
                ];
                $cat1= 0; $cat2 = 0; $cat3 = 0; $cat4 = 0; $cat5 = 0; $cat6 = 0; $cat7 = 0; $cat8 = 0;

                foreach ($lecturerWhoAnswers as $key => $std) {
                    $cat1 += LqAnswer::where('lecturer_id', $std)->where('lq_category_id', 1)->sum('answer') / 6;
                    $cat2 += LqAnswer::where('lecturer_id', $std)->where('lq_category_id', 2)->sum('answer') / 7;
                    $cat3 += LqAnswer::where('lecturer_id', $std)->where('lq_category_id', 3)->sum('answer') / 9;
                    $cat4 += LqAnswer::where('lecturer_id', $std)->where('lq_category_id', 4)->sum('answer') / 7;
                    $cat5 += LqAnswer::where('lecturer_id', $std)->where('lq_category_id', 5)->sum('answer') / 6;
                    $cat6 += LqAnswer::where('lecturer_id', $std)->where('lq_category_id', 6)->sum('answer') / 3;
                    $cat7 += LqAnswer::where('lecturer_id', $std)->where('lq_category_id', 7)->sum('answer') / 3;
                    $cat8 += LqAnswer::where('lecturer_id', $std)->where('lq_category_id', 8)->sum('answer') / 3;
                }

                    $cat1 == 0 ? $cat1 = 0 : $cat1 /= $studentLength;
                    $cat2 == 0 ? $cat2 = 0 : $cat2 /= $studentLength;
                    $cat3 == 0 ? $cat3 = 0 : $cat3 /= $studentLength;
                    $cat4 == 0 ? $cat4 = 0 : $cat4 /= $studentLength;
                    $cat5 == 0 ? $cat5 = 0 : $cat5 /= $studentLength; 
                    $cat6 == 0 ? $cat6 = 0 : $cat6 /= $studentLength; 
                    $cat7 == 0 ? $cat7 = 0 : $cat7 /= $studentLength; 
                    $cat8 == 0 ? $cat8 = 0 : $cat8 /= $studentLength; 
                    
                $max   = [(int) $cat1, (int) $cat2, (int) $cat3, (int) $cat4, (int) $cat5, (int) $cat6, (int) $cat7, (int) $cat8];
                $color = ['#ff7b54', '#ff7b54', '#ff7b54', '#ff7b54', '#ff7b54', '#ff7b54', '#ff7b54', '#ff7b54'];
                break;

            case 3:
                $studentsWhoAnswers = AqAnswer::select('alumni_id')->groupBy('alumni_id')->get()->toArray();
                $studentLength = count($studentsWhoAnswers);
                $categories = ['Akademik dan Kemahasiswaan', 'Keuangan', 'Administrasi Umum', 'Program Studi', 'Labolatorium'];
                $cat1= 0; $cat2 = 0; $cat3 = 0; $cat4 = 0; $cat5 = 0;

                foreach ($studentsWhoAnswers as $key => $std) {
                    $cat1 += AqAnswer::where('alumni_id', $std)->where('aq_category_id', 1)->sum('answer') / 4;
                    $cat2 += AqAnswer::where('alumni_id', $std)->where('aq_category_id', 2)->sum('answer') / 2;
                    $cat3 += AqAnswer::where('alumni_id', $std)->where('aq_category_id', 3)->sum('answer') / 2;
                    $cat4 += AqAnswer::where('alumni_id', $std)->where('aq_category_id', 4)->sum('answer') / 7;
                    $cat5 += AqAnswer::where('alumni_id', $std)->where('aq_category_id', 5)->sum('answer') / 6;
                }
                
                    $cat1 == 0 ? $cat1 = 0 : $cat1 /= $studentLength;
                    $cat2 == 0 ? $cat2 = 0 : $cat2 /= $studentLength;
                    $cat3 == 0 ? $cat3 = 0 : $cat3 /= $studentLength;
                    $cat4 == 0 ? $cat4 = 0 : $cat4 /= $studentLength;
                    $cat5 == 0 ? $cat5 = 0 : $cat5 /= $studentLength;
                    
                $max   = [(int) $cat1, (int) $cat2, (int) $cat3, (int) $cat4, (int) $cat5];
                $color = ['#ff7b54', '#ff7b54', '#ff7b54', '#ff7b54', '#ff7b54'];
                break;
        }
        return view('index', [
            'labels' => json_encode($categories),
            'max'   => json_encode($max),
            'color'  => json_encode($color),
        ]);
    }

    public function complain () {
        return view('report_complain');
    }

    public function complain_store (Request $request) {
        if (Auth::guard('student')->check()) {
            $user_type = 1;
            $user_id   = Auth::guard('student')->user()->id;
        }
        if (Auth::guard('lecturer')->check()) {
            $user_type = 2;
            $user_id   = Auth::guard('lecturer')->user()->id;
        }
        if (Auth::guard('alumni')->check()) {
            $user_type = 3;
            $user_id   = Auth::guard('alumni')->user()->id;
        }
        Report::create([
            'user_type' => $user_type,
            'user_id'   => $user_id,
            'subject'   => $request->subject,
            'body'      => $request->body,
        ]);
    }
}
