<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Lecturer;
use App\Models\LqAnswer;
use App\Models\LqCategory;
use App\Models\LqQuestion;
use Illuminate\Support\Facades\Auth;

class LecturerController extends Controller
{
    public function forms ($category_id) {
        $isLecturerHaveFilled = LqAnswer::where('lecturer_id', auth('lecturer')->user()->id)->first();
        if (! empty($isLecturerHaveFilled)) {
            session()->put('error', 'Anda telah mengisi kuisioner');
            return redirect()->route('dashboard');
        }

        // dd(sessio n('forms')[$category_id - 1]);
        // for hiding and showing back button
        ($category_id == 1) ? session()->put('disablebtn', true) : session()->put('disablebtn', false);
        // for button back
        ($category_id !== 1) ? session()->put('backurl', $category_id-1) : session()->forget('backurl');

        $questionCategory = LqCategory::find($category_id);
        $questions = LqQuestion::where('lq_category_id', $category_id)->get();
        session()->put('category', $questionCategory);
        session()->put('questions', $questions);

        // apakah sudah ada jawabannya
        $arrForms = session('forms');
        (session('forms') != null && !empty($arrForms[$category_id])) ? 
            $answer = json_decode($arrForms[ $category_id]) : // array session form mulai dari 0
            $answer = null;

        return view('forms_lecturer', [
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

        $checkCategory = LqCategory::find($nextCategoryId);
        if ($checkCategory) {
            return redirect()->action(
                [LecturerController::class, 'forms'], 
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
        $s = LqCategory::all();
        foreach ($s as $value) {
            foreach ($value->lq_question as $key => $questions) {
                LqAnswer::create([
                    'answer'         => $answers[$key],
                    'lecturer_id'     => Auth::guard('lecturer')->user()->id,
                    'lq_category_id' => $value->id,
                    'lq_question_id' => $questions->id
                ]);
            }
        }

        Lecturer::find(Auth::guard('lecturer')->user()->id)->update([ 'filled' => date('Y-m-d H:i:s') ]);

        session()->put('success', 'Berhasil isi formulir kuisioner');
        return redirect()->route('dashboard');
            
    }

    public function profile () {
        session()->put('dashboard', false);
        $lecturer_id = Auth::guard('lecturer')->user()->id;
        $lecturer = Lecturer::find($lecturer_id);
        return view('profile_lecturer', [
            'lecturer' => $lecturer
        ]);
    }

    public function profilestore (Request $request) {
        Lecturer::where('nidn', $request->nidn)->update([
            'phone' => $request->phone,
            'email' => $request->email,
        ]);
        return back()->withSuccess('Berhasil update profil');
    }
}
