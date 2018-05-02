<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Category;
use App\Models\Choice;

class QuestionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Question::getAll()->map(function($question) {
            return $question->parse();
        });
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::get(['id', 'name']);
         return [
            'categories' => $categories
        ];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { //return $request;
        $this->validateRequest($request);

         $question=new Question();
         $question->description=$request->description;
         $question->category_id=$request->category_id;
         $question->answer=$request->answer;
       //$data['phone_number'] = parse_phone_number($data['phone_number']);
         $question->save();

         //if($question->type !=1){
          $choices =$request->choices;
          $choice=new Choice();
          $choice->question_id=$question->id;
          $choice->description=json_encode(json_decode($choices));
          $choice->save();        

          return $question->parse();
    }

    private function validateRequest(Request $request)
    {
        $request->validate([
            'description' => 'required',
            'answer' => 'required',
            'choices'=>'required'
            
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Question::getAll($id)->parse();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = $this->create();
        $data['question'] = $this->show($id);

        return $data;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validateRequest($request);

        $question = Question::getAll($id);
        $question->update($request->all());

        return $question->parse();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Question::findOrFail($id)->delete();

        return [
            "success" => 1
        ];
    }
}
