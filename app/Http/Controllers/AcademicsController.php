<?php

namespace App\Http\Controllers;

use App\Models\Alumni;
use App\Models\AqAnswer;
use App\Models\Lecturer;
use App\Models\LqAnswer;
use App\Models\Report;
use App\Models\SqAnswer;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AcademicsController extends Controller
{
        public function index() {
        session()->forget('complain');
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
            [AcademicsController::class, 'actortype'], ['role' => 1]
        );
    }

    public function actortype($role) {
        session()->put('actor', $role);
        session()->put('visual', 1);
        session()->put('dashboard', TRUE);
        return redirect()->action(
            [AcademicsController::class, 'summary'], ['role' => $role]
        );
    }

    // Summary: 1, 2, X
    // Line: 1, X, 3
    // Bar: 1, X, dosen tidak ada
    // Detail: 0

    public function summary ($role) {
        session()->put('visual', 1);
        switch ($role) {
            case 1:
                    // student
                    $agree = SqAnswer::whereIn('answer', [3, 4])->count();
                    $disagree = SqAnswer::whereIn('answer', [1, 2])->count();
                break;
            
            case 2:
                // lecturer
                    $agree = LqAnswer::whereIn('answer', [3, 4])->count();
                    $disagree = LqAnswer::whereIn('answer', [1, 2])->count();
                break;
            
            case 3:
                    $agree = AqAnswer::whereIn('answer', [3, 4])->count();
                    $disagree = AqAnswer::whereIn('answer', [1, 2])->count();
                break;

        }
        
        if($agree == 0 && $disagree == 0) {
            $percentage = [
                'agree' => 50,
                'disagree' => 50,
            ];
        } else {
            $percentage = [
                'agree' => number_format((float)($agree / ($agree + $disagree)) * 100, 2, '.', ''),
                'disagree' => number_format((float)($disagree / ($agree + $disagree)) * 100, 2, '.', ''),
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
                $students = DB::table('students')->selectRaw('YEAR(students.filled) as year')->where('filled' ,'!=', null)->distinct()->get();
                $arrData = [];
                // loop berdasarkan tahun menghasilkan year di variabel value
                foreach ($students as $year) {
                    // menghasilkan student id pertahun
                    $studentsPerYears = Student::whereYear('filled', $year->year)->select('id')->get()->toArray();
                    $numberOfStudents = count($studentsPerYears);
                    $data = 0;
                    $numberOfTrueAnswer = 0;

                    // loop berdasarkan tiap2 student id yg tahunnya sama
                        foreach ($studentsPerYears as $key => $value) {
                            $trueanswer = SqAnswer::where('student_id', $value)->whereIn('answer', [3, 4])->count();
                            $trueanswer = (int) $trueanswer / 32 * 100;
                            $numberOfTrueAnswer += $trueanswer;
                        }
                        $numberOfTrueAnswer = $numberOfTrueAnswer / $numberOfStudents;
                        $arrData [] =
                            [
                                'year' => $year->year,
                                'percentage' => $numberOfTrueAnswer
                            ];

                }
                $arrOther = [
                    [ 'year' => 2019, 'percentage' => 80, ],[ 'year' => 2020, 'percentage' => 65, ]
                ];

                $data = array_merge($arrOther, $arrData);
                $years = []; $percentage = [];
                foreach ($data as $key => $value) {
                    $years [] = $value['year'];
                    $percentage [] = $value['percentage'];
                }
                return view('index', [
                    'years' => json_encode($years),
                    'total' => json_encode($percentage),
                    'person' => $person,
                ]);
                break;
            
            case 2:
                $person = 'Dosen';

                $lecturer = DB::table('lecturers')->selectRaw('YEAR(lecturers.filled) as year')->where('filled' ,'!=', null)->distinct()->get();
                $arrData = [];
                foreach ($lecturer as $year) {
                    $lecturerPerYears = Lecturer::whereYear('filled', $year->year)->select('id')->get()->toArray();
                    $numberOflecturer = count($lecturerPerYears);
                    $data = 0;
                    $numberOfTrueAnswer = 0;
                        foreach ($lecturerPerYears as $key => $value) {
                            $trueanswer = LqAnswer::where('lecturer_id', $value)->whereIn('answer', [3, 4])->count();
                            $trueanswer = (int) $trueanswer / 44 * 100;
                            $numberOfTrueAnswer += $trueanswer;
                        }
                        $numberOfTrueAnswer = $numberOfTrueAnswer / $numberOflecturer;
                        $arrData [] = [ 'year' => $year->year, 'percentage' => $numberOfTrueAnswer ];
                }
                $arrOther = [
                    [ 'year' => 2019, 'percentage' => 70, ],[ 'year' => 2020, 'percentage' => 85, ]
                ];

                $data = array_merge($arrOther, $arrData);
                $years = []; $percentage = [];
                foreach ($data as $key => $value) {
                    $years [] = $value['year'];
                    $percentage [] = $value['percentage'];
                }

                return view('index', [
                    'years' => json_encode($years),
                    'total' => json_encode($percentage),
                    'person' => $person,
                ]);
                break;

            case 3:
                $person = 'Alumni';
                $alumni = DB::table('alumnus')->selectRaw('YEAR(alumnus.filled) as year')->where('filled' ,'!=', null)->distinct()->get();
                $arrData = [];
                foreach ($alumni as $year) {
                    $alumniPerYears = Alumni::whereYear('filled', $year->year)->select('id')->get()->toArray();
                    $numberOfalumni = count($alumniPerYears);
                    $data = 0;
                    $numberOfTrueAnswer = 0;
                        foreach ($alumniPerYears as $key => $value) {
                            $trueanswer = AqAnswer::where('alumni_id', $value)->whereIn('answer', [3, 4])->count();
                            $trueanswer = (int) $trueanswer / 18 * 100;
                            $numberOfTrueAnswer += $trueanswer;
                        }
                        $numberOfTrueAnswer = $numberOfTrueAnswer / $numberOfalumni;
                        $arrData [] =
                            [
                                'year' => $year->year,
                                'percentage' => $numberOfTrueAnswer
                            ];

                }
                $arrOther = [
                    [ 'year' => 2019, 'percentage' => 80, ],[ 'year' => 2020, 'percentage' => 90, ]
                ];
                $data = array_merge($arrOther, $arrData);
                $years = []; $percentage = [];
                foreach ($data as $key => $value) {
                    $years [] = $value['year'];
                    $percentage [] = $value['percentage'];
                }
                return view('index', [
                    'years' => json_encode($years),
                    'total' => json_encode($percentage),
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
                $studentsWhoAnswers = SqAnswer::select('student_id')->groupBy('student_id')->get();

                // SI
                $si = Student::whereIn('id', $studentsWhoAnswers)->where('major', 1)->whereYear('filled', date('Y'))->select('id')->get()->toArray();
                $siTotalAnswer = 0;
                $siNumberOfStudent = count($si);
                $aa = [];
                foreach ($si as $key => $std) {
                    $answers = SqAnswer::where('student_id', $std)->whereIn('answer', [3, 4])->count();
                    $aa [] = $answers;
                    $answers = $answers / 32 * 100;
                    $siTotalAnswer += $answers;
                }
                $siTotalAnswer == 0 ? $siTotalAnswer = 0 : $siTotalAnswer /= $siNumberOfStudent;

                // TI
                $ti = Student::whereIn('id', $studentsWhoAnswers)->where('major', 2)->whereYear('filled', date('Y'))->select('id')->get()->toArray();
                $tiTotalAnswer = 0;
                $tiNumberOfStudent = count($ti);
                foreach ($ti as $key => $std) {
                    $answers = SqAnswer::where('student_id', $std)->whereIn('answer', [3, 4])->count();
                    $answers = $answers / 32 * 100;
                    $tiTotalAnswer += $answers;
                }
                $tiTotalAnswer == 0 ? $tiTotalAnswer = 0 : $tiTotalAnswer /= $tiNumberOfStudent;

                // MI
                $mi = Student::whereIn('id', $studentsWhoAnswers)->where('major', 3)->whereYear('filled', date('Y'))->select('id')->get()->toArray();
                $miTotalAnswer = 0;
                $miNumberOfStudent = count($mi);
                foreach ($mi as $key => $std) {
                    $answers = SqAnswer::where('student_id', $std)->whereIn('answer', [3, 4])->count();
                    $answers = $answers / 32 * 100;
                    $miTotalAnswer += $answers;
                }
                $miTotalAnswer == 0 ? $miTotalAnswer = 0 : $miTotalAnswer /= $miNumberOfStudent;

                $data = [(int) $siTotalAnswer, (int) $tiTotalAnswer, (int) $miTotalAnswer];
                // dd($data);
                return view('index', [
                    'data' => json_encode($data)
                ]);
                break;

            case 3:
                $alumniWhoAnswers = AqAnswer::select('alumni_id')->groupBy('alumni_id')->get();

                // SI
                $si = Alumni::whereIn('id', $alumniWhoAnswers)->where('major', 1)->whereYear('filled', date('Y'))->select('id')->get()->toArray();
                $siTotalAnswer = 0;
                $siNumberOfAlumni = count($si);
                foreach ($si as $key => $std) {
                    $answers = AqAnswer::where('alumni_id', $std)->whereIn('answer', [3, 4])->count();
                    $answers = (int) $answers / 32 * 100;
                    $siTotalAnswer += $answers;
                }
                $siTotalAnswer == 0 ? $siTotalAnswer = 0 : $siTotalAnswer /= $siNumberOfAlumni;

                // TI
                $ti = Alumni::whereIn('id', $alumniWhoAnswers)->where('major', 2)->whereYear('filled', date('Y'))->select('id')->get()->toArray();
                $tiTotalAnswer = 0;
                $tiNumberOfAlumni = count($ti);
                foreach ($ti as $key => $std) {
                    $answers = AqAnswer::where('alumni_id', $std)->whereIn('answer', [3, 4])->count();
                    $answers = (int) $answers / 32 * 100;
                    $tiTotalAnswer += $answers;
                }
                $tiTotalAnswer == 0 ? $tiTotalAnswer = 0 : $tiTotalAnswer /= $tiNumberOfAlumni;

                // MI
                $mi = Alumni::whereIn('id', $alumniWhoAnswers)->where('major', 3)->whereYear('filled', date('Y'))->select('id')->get()->toArray();
                $miTotalAnswer = 0;
                $miNumberOfAlumni = count($mi);
                foreach ($mi as $key => $std) {
                    $answers = AqAnswer::where('alumni_id', $std)->whereIn('answer', [3, 4])->count();
                    $answers = (int) $answers / 32 * 100;
                    $miTotalAnswer += $answers;
                }
                $miTotalAnswer == 0 ? $miTotalAnswer = 0 : $miTotalAnswer /= $miNumberOfAlumni;

                $data = [(int) $siTotalAnswer, (int) $tiTotalAnswer, (int) $miTotalAnswer];
                return view('index', [
                    'data' => json_encode($data)
                ]);
                break;
        }
    }

    public function detail ($role) {
        session()->put('visual', 4);

        switch ($role) {
            case 1: 
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

                $categories = [
                    'Tangibles', 'Reliability', 'Responsiveness', 'Assurance', 'Empathy'
                ];  
                $cat1 == 0 ? $avg_cat1 = 0 : $avg_cat1 = $cat1 / $countStudent;
                $cat2 == 0 ? $avg_cat2 = 0 : $avg_cat2 = $cat2 / $countStudent;
                $cat3 == 0 ? $avg_cat3 = 0 : $avg_cat3 = $cat3 / $countStudent;
                $cat4 == 0 ? $avg_cat4 = 0 : $avg_cat4 = $cat4 / $countStudent;
                $cat5 == 0 ? $avg_cat5 = 0 : $avg_cat5 = $cat5 / $countStudent;
                    
                $max   = [
                    number_format((float)$avg_cat1, 2, '.', ''),
                    number_format((float)$avg_cat2, 2, '.', ''),
                    number_format((float)$avg_cat3, 2, '.', ''),
                    number_format((float)$avg_cat4, 2, '.', ''),
                    number_format((float)$avg_cat5, 2, '.', ''),
                ];
                $color = ['#ff7b54', '#ff7b54', '#ff7b54', '#ff7b54', '#ff7b54'];

                return view('index', [
                    'labels' => json_encode($categories),
                    'max'   => json_encode($max),
                    'color'  => json_encode($color),
                ]);
                break;
            
            case 2:

                $answers = LqAnswer::select('lecturer_id')->groupBy('lecturer_id')->get()->toArray();
                $countlecturer = count($answers);
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

                $cat1 == 0 ? $avg_cat1 = 0 : $avg_cat1 = $cat1 / $countlecturer;
                $cat2 == 0 ? $avg_cat2 = 0 : $avg_cat2 = $cat2 / $countlecturer;
                $cat3 == 0 ? $avg_cat3 = 0 : $avg_cat3 = $cat3 / $countlecturer;
                $cat4 == 0 ? $avg_cat4 = 0 : $avg_cat4 = $cat4 / $countlecturer;
                $cat5 == 0 ? $avg_cat5 = 0 : $avg_cat5 = $cat5 / $countlecturer;
                $cat6 == 0 ? $avg_cat6 = 0 : $avg_cat6 = $cat6 / $countlecturer;
                $cat7 == 0 ? $avg_cat7 = 0 : $avg_cat7 = $cat7 / $countlecturer;
                $cat8 == 0 ? $avg_cat8 = 0 : $avg_cat8 = $cat8 / $countlecturer;
                    
                $max   = [
                    number_format((float)$avg_cat1, 2, '.', ''),
                    number_format((float)$avg_cat2, 2, '.', ''),
                    number_format((float)$avg_cat3, 2, '.', ''),
                    number_format((float)$avg_cat4, 2, '.', ''),
                    number_format((float)$avg_cat5, 2, '.', ''),
                    number_format((float)$avg_cat6, 2, '.', ''),
                    number_format((float)$avg_cat7, 2, '.', ''),
                    number_format((float)$avg_cat8, 2, '.', ''),
                ];

                $color = ['#ff7b54', '#ff7b54', '#ff7b54', '#ff7b54', '#ff7b54', '#ff7b54', '#ff7b54', '#ff7b54'];

                return view('index', [
                    'labels' => json_encode($categories),
                    'max'    => json_encode($max),
                    'color'  => json_encode($color),
                ]);

                break;

            case 3:

                $answers = AqAnswer::select('alumni_id')->groupBy('alumni_id')->get()->toArray();
                $countalumni = count($answers);
                $categories = ['Umum', 'Mutu dan Kompetensi Lulusan', 'Kebutuhan Stakeholder Kota'];

                $cat1 = 0; $cat2 = 0; $cat3 = 0;
                foreach ($answers as $key => $val) {
                    $alumni_id = $val;
                    $cat1 += AqAnswer::where('alumni_id', $alumni_id)->where('aq_category_id', 1)->sum('answer') / 9;
                    $cat2 += AqAnswer::where('alumni_id', $alumni_id)->where('aq_category_id', 2)->sum('answer') / 4;
                    $cat3 += AqAnswer::where('alumni_id', $alumni_id)->where('aq_category_id', 3)->sum('answer') / 5;
                }

                $cat1 == 0 ? $avg_cat1 = 0 : $avg_cat1 = $cat1 / $countalumni;
                $cat2 == 0 ? $avg_cat2 = 0 : $avg_cat2 = $cat2 / $countalumni;
                $cat3 == 0 ? $avg_cat3 = 0 : $avg_cat3 = $cat3 / $countalumni;
                    
                $max   = [
                    number_format((float)$avg_cat1, 2, '.', ''),
                    number_format((float)$avg_cat2, 2, '.', ''),
                    number_format((float)$avg_cat3, 2, '.', ''),
                ];
                $color = ['#ff7b54', '#ff7b54', '#ff7b54'];

                return view('index', [
                    'labels' => json_encode($categories),
                    'max'    => json_encode($max),
                    'color'  => json_encode($color),
                ]);
                
                break;
        }
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
        session()->put('success', 'Anda telah mengisi form komplain');
        return redirect()->back();
    }

    public function complain_list ($role_id) {
        session()->forget('dashboard');
        session()->put('complain', true);
        session()->put('role', $role_id);
        return view('report_complain_list');
    }

    public function complain_detail ($report_id) {
        $report = Report::find($report_id);
        return view('report_complain_detail', [
            'data' => $report
        ]);
    }

    public function complain_remove ($report_id) {
        Report::find($report_id)->delete();
        session()->put('success', 'Berhasil menghapus pengaduan');
        return redirect()->route('complain.list', 1);
    }

    public function complain_received ($report_id) {
        Report::find($report_id)->increment('status');
        session()->put('success', 'Laporan telah diterima');
        return redirect()->route('complain.list', 1);
    }
}
