<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use    App\Models\Question;
use    App\Models\Answer;
use    App\Models\Action;
use    App\Models\Risk;
use    App\Models\Project;
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
             // delete doble spaces
            $a = preg_replace('/\s+/', ' ', $a);
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
     public function similar(Request $request) {
        if (isset($request->threshold)) {
            $threshold = $request->threshold;
        } else {
            $threshold = 90; // Порог сходства в процентах
        }
        // заглушка если не указан проект то первый
        if (isset($request->project_id)) {
           $project =Project::find($request->project_id);
        } else {
            $project = Project::first();
        }
        // выбираем риски для проекта
 
        $risks=$project->topics->first()->risks;
        $qs=[];    // выбираем вопросы для проекта  risks   risk_question
        foreach($risks as $risk)
        {
            $qs = array_merge($qs, $risk->questions->toArray());
        }
        $non_similar_questions = [];
        while (!empty($qs)) {
            $current_question = array_shift($qs); // Получаем первый вопрос из массива

            // Проверяем, является ли текущий вопрос похожим на другие вопросы
            $is_similar = false;
            foreach ($qs as $q) {
                $percent = 0;
                similar_text($current_question['content'], $q['content'], $percent);

                if ($percent >= $threshold) {
                    $is_similar = true;
                    break;
                }
            }

            if (!$is_similar) {
                $non_similar_questions[] = $current_question;
            }
        }
      //  return   $non_similar_questions ;
          return view('question.similar', compact('non_similar_questions', 'threshold'));
    }
   public function similars($question, $qs, $threshold, $mass_qs)
    {
        $questions = collect();

        foreach ($qs as $q) {
            similar_text($question['content'], $q['content'], $percent);

            if ($percent >= $threshold && $q['id'] !== $question['id'] && !$mass_qs->contains('id', $q['id'])) {
               
                $mass_qs->push($q['id']);
            }
            else{
               $questions->push($q['id']);
            }
        }

        return [$questions, $mass_qs];
    }

}
