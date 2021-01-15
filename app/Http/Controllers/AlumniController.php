<?php

namespace App\Http\Controllers;

use App\Models\Alumni;
use App\Models\AqAnswer;
use App\Models\AqCategory;
use App\Models\AqQuestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AlumniController extends Controller
{

        public function forms ($category_id) {
        $isAlumniHaveFilled = AqAnswer::where('alumni_id', auth('alumni')->user()->id)->first();
        if (! empty($isAlumniHaveFilled)) {
            session()->put('error', 'Anda telah mengisi kuisioner');
            return redirect()->route('dashboard');
        }
        
        ($category_id == 1) ? session()->put('disablebtn', true) : session()->put('disablebtn', false);
        ($category_id !== 1) ? session()->put('backurl', $category_id-1) : session()->forget('backurl');

        $questionCategory = AqCategory::find($category_id);
        $questions = AqQuestion::where('aq_category_id', $category_id)->get();
        session()->put('category', $questionCategory);
        session()->put('questions', $questions);

        // apakah sudah ada jawabannya
        $arrForms = session('forms');
        (session('forms') != null && !empty($arrForms[$category_id])) ? 
            $answer = json_decode($arrForms[ $category_id]) : // array session form mulai dari 0
            $answer = null;

        return view('forms_alumni', [
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

        $checkCategory = AqCategory::find($nextCategoryId);
        if ($checkCategory) {
            return redirect()->action(
                [AlumniController::class, 'forms'], 
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
            $s = AqCategory::all();
          foreach ($s as $value) {
                foreach ($value->aq_question as $key => $questions) {
                    AqAnswer::create([
                        'answer'         => $answers[$key],
                        'alumni_id'     => Auth::guard('alumni')->user()->id,
                        'aq_category_id' => $value->id,
                        'aq_question_id' => $questions->id
                    ]);
                }
            }

            Alumni::find(Auth::guard('alumni')->user()->id)->update([ 'filled' => date('Y-m-d H:i:s') ]);

            session()->put('success', 'Berhasil isi formulir kuisioner');
            return redirect()->route('dashboard');
            
        }

        public function profile () { 
            session()->put('dashboard', false);
            $alumni_id = Auth::guard('alumni')->user()->id;
            $alumni = Alumni::find($alumni_id);
            return view('profile_alumni', [
                'alumni' => $alumni
            ]);
        }
    
        public function profilestore (Request $request) {
            alumni::where('nim', $request->nim)->update([
                'phone' => $request->phone,
                'email' => $request->email,
            ]);
            return back()->withSuccess('Berhasil update profil');
        }
}
