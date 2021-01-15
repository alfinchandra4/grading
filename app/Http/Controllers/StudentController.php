<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\SqAnswer;
use App\Models\SqCategory;
use App\Models\SqQuestion;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
 
    public function forms ($category_id) {
        $isStudentHaveFilled = SqAnswer::where('student_id', auth('student')->user()->id)->first();
        if (! empty($isStudentHaveFilled)) {
            session()->put('error', 'Anda telah mengisi kuisioner');
            return redirect()->route('dashboard');
        }
        
        // dd(session('forms')[$category_id - 1]);
        // for hiding and showing back button
        ($category_id == 1) ? session()->put('disablebtn', true) : session()->put('disablebtn', false);
        // for button back
        ($category_id !== 1) ? session()->put('backurl', $category_id-1) : session()->forget('backurl');

        $questionCategory = SqCategory::find($category_id);
        $questions = SqQuestion::where('sq_category_id', $category_id)->get();
        session()->put('category', $questionCategory);
        session()->put('questions', $questions);

        // apakah sudah ada jawabannya
        $arrForms = session('forms');
        (session('forms') != null && !empty($arrForms[$category_id])) ? 
            $answer = json_decode($arrForms[ $category_id]) : // array session form mulai dari 0
            $answer = null;

        return view('forms_student', [
            'answer' => $answer
        ]);
    }

    public function formstore (Request $request) {

        // If old category have a answer, then replace the answer with the new answer
        if (isset(session('forms')[$request->category_id])) {
            $arrForms = session('forms');
            unset($arrForms[$request->category_id]);
            session()->put('forms', $arrForms);
        }
        // dd([ $request->category_id => json_encode($request->ans)]);
        $arrForms = session()->get('forms');
        $arrForms [ $request->category_id ] = json_encode($request->ans);
        session()->put('forms', $arrForms);
        $nextCategoryId = $request->category_id + 1;

        $checkCategory = SqCategory::find($nextCategoryId);
        if ($checkCategory) {
            return redirect()->action(
                [StudentController::class, 'forms'], 
                ['category_id' => $nextCategoryId]
            );
        }
            $arrForms = session('forms');

            // Decoding the answer first
            $decoding = [];
            foreach ($arrForms as $key => $value) {
                $decoding [] = json_decode($value);
            }
            
            // merging the answer to array
            $answers = [];
            foreach ($decoding as $key => $value) {
                foreach ($decoding[$key] as $val) {
                    $answers [] = $val;
                }
            }

            // store data
            $s = SqCategory::all();
            foreach ($s as $value) {
                foreach ($value->sq_question as $key => $questions) {
                    SqAnswer::create([
                        'answer'         => $answers[$key],
                        'student_id'     => Auth::guard('student')->user()->id,
                        'sq_category_id' => $value->id,
                        'sq_question_id' => $questions->id
                    ]);
                }
            }

            Student::find(Auth::guard('student')->user()->id)->update([ 'filled' => date('Y-m-d H:i:s') ]);

            session()->put('success', 'Berhasil isi formulir kuisioner');
            return redirect()->route('dashboard');
            
    }

    public function profile () { 
        session()->put('dashboard', false);
        $student_id = Auth::guard('student')->user()->id;
        $student = Student::find($student_id);
        return view('profile_student', [
            'student' => $student
        ]);
    }

    public function profilestore (Request $request) {
        Student::where('nim', $request->nim)->update([
            'phone' => $request->phone,
            'email' => $request->email,
        ]);
        return back()->withSuccess('Berhasil update profil');
    }

    // Secondary Utilities
    public function checkforms() {
        // return back()->withSuccess('ok');
        dd(session('forms'));
    }

    public function clearforms() {
        session()->forget('forms');
    }

}

