<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Answer;
use App\Models\Question;
use App\Models\Applicant;
   
class TestController extends Controller
{
   
     public function start($code)
    {
        return  $this->showQuestion(null);
    }

    public function answer(Request $request, $code)
    {    
        $this->validateRequest($request);
        $answer=new Answer();
        $answer->question_id=$request->question_id;
        $answer->applicant_id=Applicant::getApplicantId($code);
        $answer->answer=$request->answer;
        //return $answer->isAnswer();
        $answer->right=$answer->isAnswer();
        $answer->save();
        return  $this->showQuestion($answer->question_id);

    }


     public function showQuestion($id)
    {
        return Question::getNext($id);
    }


     private function validateRequest(Request $request)
    {
        $request->validate([
            'answer' => 'required',
            'question_id'=>'required'
        ]);
    }


     public function getUserAnswers($id)
    {   $GLOBALS['score'] =0;
        $data= Answer::where('applicant_id', '=', $id)
                      ->get()->map(function($answer) {
            if($answer->right==1)
                $GLOBALS['score']++;
            return $answer->parse();
        });

        return ['score'=>$GLOBALS['score'],
                    'answers'=>$data];
     }

}

