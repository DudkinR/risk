<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Topic;
use App\Models\Risk;
use App\Models\Question;
use Illuminate\Support\Facades\Auth;


class RiskController extends Controller
{
    public function index(Request $request)
    {
        //
        if(isset($_Get['risk_id']))
        {
            $risks = Risk::where('under_id','=',$_Get['risk_id'])->get();
        }
        else
        {
            $risks = Risk::where('under_id','=','0')->get();
        }
        return view('risk.index',compact('risks'));
     }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        //
        if(isset($request->under_id))
        {
            $risk_id = $request->under_id;
        }
        else
        {
            $risk_id = 0;
        }
        $risks =   Risk::all();
        return view('risk.create',['under_risk'=>$risk_id,'risks'=>$risks]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // validate
        $request->validate([
            'title' => 'required',
            'anatation' => 'required',
        ]);
        // store
        if(isset($request->under_risk)){
            $risk_id = $request->under_risk;
        }
        else
        {
            $risk_id = 0;
        }
        $risk = new Risk;
        $risk->under_id = $risk_id;
        $risk->title = $request->title;
        $risk->anatation = $request->anatation;
        $risk->save();
        return redirect()->route('risk.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //

        $risk = Risk::find($id);
        if($risk->under_id >0)
            $under_risk=   Risk::find($risk->under_id);
        else
            $under_risk = null;
        //where all and order by id desc
        $questions=  Question::where('under_id','=',0)->orderBy('id','desc')->get();
        return view('risk.show',compact('risk','under_risk','questions'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $risk = Risk::find($id);
        $risks =    $risks =   Risk::all();
        $under_risk=   $risk->under_id;
        return view('risk.edit',compact('risk','under_risk','risks'));                                                                                               
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //  validate
        $request->validate([
            'title' => 'required',
            'anatation' => 'required',
        ]);
        // store
        $risk = Risk::find($id);
        $risk->under_id = $request->under_risk;
        $risk->title = $request->title;
        $prject->anatation = $request->anatation;
        $risk->save();

        return redirect('risk.show',compact('risk'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $risk = Risk::find($id);
        $risk->delete();
        return redirect()->route('risk.index');
    }
    // addquestion - добавить вопрос к риску
    public function addquestion(Request $request)
    {
        // validate
        $request->validate([
   
            'question' => 'required',
            'risk_id' => 'required',
        ]);
        $risk = Risk::find($request->risk_id);
        if(isset($request->separate) && $request->separate=1){
          // separate $request->question to rows
          $questions = explode("\n",$request->question);
            foreach($questions as $q)
            {  if($q != '' && Question::where('content','=',$q)->count() == 0)
                {
                $question = new Question;
                $question->content = $q;
                $question->save();
                $risk->questions()->attach($question->id);
                }
                elseif(Question::where('content','=',$q)->count() > 0) {
                  $question = Question::where('content','=',$q)->first();
                    $risk->questions()->attach($question->id);
                }
            }
        }
        else
        {
             if( Question::where('content','=', $request->question)->count() == 0)
                {
                    $question = new Question;
                    $question->content = $request->question;
                    $question->save();
                    $risk->questions()->attach($question->id);
                }
                elseif(Question::where('content','=',$request->question)->count() > 0) {
                  $question = Question::where('content','=',$request->question)->first();
                    $risk->questions()->attach($question->id);
                }

        }
       
        return redirect()->route('risk.show',$request->risk_id);
    }
// addquestions - добавить вопросы к риску
public function addquestions(Request $request)
    {
        // validate
        $request->validate([
            'questions' => 'required',
            'risk_id' => 'required',
        ]);
        $risk  = Risk::find($request->risk_id);
        // detach all questions
        $risk->questions()->detach();
        // attach new questions
        $risk->questions()->attach($request->questions);
        return redirect()->route('risk.show',$request->risk_id);
    }
}
