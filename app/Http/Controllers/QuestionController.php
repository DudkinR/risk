<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use    App\Models\Question;
use    App\Models\Answer;
use  Illuminate\Support\Facades\Auth;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $questions = Question::orderBy('id', 'desc')->get();
        return view('question.index', compact('questions'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        //
        $questions = Question::orderBy('id', 'desc')->get();
        if(isset($request->q_id))
        {
            $under_id = $request->q_id;
        }
        else
        {
            $under_id = 0;
        }
        return view('question.create', compact('questions','under_id'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $question = new Question;
        $question->content = $request->content;
        $question->under_question = $request->under_question;
        $question->save();
        return redirect()->route('question.index',['#question'.$question->id]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $question = Question::find($id);
        return view('question.show', compact('question'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request,string $id)
    {
        //
        $question = Question::find($id);
        $questions = Question::orderBy('id', 'desc')->get();
        return view('question.edit', compact('question','questions'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $question = Question::find($id);
        $question->content = $request->content;
        $question->under_question = $request->under_question;
        $question->save();
        return redirect()->route('question.index',['#question'.$question->id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $question = Question::find($id);
        $question->delete();
        $under_questions = Question::where('under_question','=',$id)->get();
        // under+question = 0
        foreach($under_questions as $uq)
        {
            $uq->under_question = 0;
            $uq->save();
        }
        return redirect()->route('question.index');
    }
    public function addanswers(Request $request){
        $question = Question::find($request->question_id);
        $answers = explode("\n",$request->answers);
            foreach($answers as $a)
            {
             $a= trim($a) ;
            if($a != '' && Answer::where('content','=',$a)->count() == 0)
                {
                    $answer = new Answer;
                    $answer->content = $a;
                    $answer->user_id = Auth::id();
                    $answer->is_correct = 1;
                    $answer->save();
                    $question->answers()->attach($answer->id);
            
                }
                elseif(Answer::where('content','=',$a)->count() > 0) {
                    $answer = Answer::where('content','=',$a)->first();
                    $question->answers()->attach($answer->id);
                }
            }
        return redirect()->route('question.index',['#question'.$request->question_id]);
    }
}
