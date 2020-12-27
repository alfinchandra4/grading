<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\SqAnswer;
use App\Models\SqCategory;
use App\Models\SqQuestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Alert;

class StudentController extends Controller
{
    public function index() {
        session()->put('actor', 1);
        session()->put('visual', 1);
        $routes = [
            'student.actor.visual.summary',
            'student.actor.visual.line',
            'student.actor.visual.bar',
            'student.actor.visual.detail'
        ];
        session()->put('routes', $routes);
        return redirect()->action(
            [StudentController::class, 'actortype'], ['role' => 1]
        );
    }

    public function actortype($role) {
        session()->put('actor', $role);
        session()->put('visual', 1);
        return redirect()->action(
            [StudentController::class, 'summary'], ['role' => $role]
        );
    }

    public function summary ($role) {
        session()->put('visual', 1);

        switch ($role) {
            // different actor
            case 1:
                // student
                $text = 'Role 1 Define';
                break;
            
            case 2:
                // lecturer
                $text = 'Role 2 Define';
                break;
            
            case 3:
                $text = 'Role 3 Define';
                break;
        
            case 4:
                $text = 'Role 4 Define';
                break;
        }
        return view('student.index', [
            'text' => $text
        ]);
    }

    public function line ($role) {
        session()->put('visual', 2);

        switch ($role) {
            case 1:
                $text = 'Role 1 statistik';
                break;
            
            case 2:
                $text = 'Role 2 statistik';
                break;

            case 3:
                $text = 'Role 3 statistik';
                break;
        
            case 4:
                $text = 'Role 4 statistik';
                break;
        }
        return view('student.index', [
            'text' => $text
        ]);
    }

    public function bar ($role) {
        session()->put('visual', 3);

        switch ($role) {
            case 1:
                $text = 'Role 1 bar';
                break;
            
            case 2:
                $text = 'Role 2 bar';
                break;

            case 3:
                $text = 'Role 3 bar';
                break;
        
            case 4:
                $text = 'Role 4 bar';
                break;
        }
        return view('student.index', [
            'text' => $text
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
        
            case 4:
                $text = 'Role 4 detail';
                break;
        }
        return view('student.index', [
            'text' => $text
        ]);
    }
 
    public function forms ($category_id) {
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

        return view('student.forms', [
            'answer' => $answer
        ]);
    }

    public function checkforms() {
        dd(session('forms'));
    }

    public function clearforms() {
        session()->forget('forms');
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
        } else {
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
            // toast('Berhasil isi kuisioner','success');
            Alert::success('Success Title', 'Success Message');
            return redirect()->route('student.index');
        }
    }

}

