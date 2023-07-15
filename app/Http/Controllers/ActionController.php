<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Action;
use App\Models\Question;
use App\Models\Answer;
use Illuminate\Support\Facades\Auth;

// Cache
use Illuminate\Support\Facades\Cache;
class ActionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
       // return
         $questions= Question::orderBy('id','desc')
        ->with('answers')
        ->with('answers.actions')
        // and $question->answers->actions->count()==0
        ->whereHas('answers', function($query){
            $query->whereDoesntHave('actions');
        })
      // ->count();
       ->get();

      //  $actions= Action::orderBy('id','desc')->get();
        return view('action.index',['questions'=>$questions]);
    }
    public function newaction(Request $request, string $id)
    {
       $answer=Answer::find($id);
       $question=Question::find($request->question_id);
       // если поле нейм пустое , то назначаем по умолчанию название вопроса
        if($request->name!==null)
         {
              $request->name=$question->title;
         }
       if(isset($request->separate)&&$request->separate==1)
       {
          $strings = preg_split('/\r\n|\r|\n/', $request->description);

        foreach ($strings as $string) {
            // находим первый символ : и разбиваем строку на 2 части  [0] => "name" [1] => "description"
            $data = explode(":", $string);
            if (count($data) == 2 && $data[0] !== null) {
                $action = $this->new_action($data[0], $data[1], $request->status);
                $answer->actions()->attach($action->id);
            } elseif (count($data) == 1 && trim($data[0]) !== '' && $data[0] !== null) {
                $action = $this->new_action($request->name, $data[0], $request->status);
                $answer->actions()->attach($action->id);
            } elseif (count($data) > 2 && trim($data[0]) !== '' && $data[0] !== null) {
                $qw = '';
                for ($i = 1; $i < count($data); $i++) {
                    $qw .= $data[$i] . '. ';
                }
                $action = $this->new_action($data[0], $qw, $request->status);
                $answer->actions()->attach($action->id);
            } elseif (trim($string) !== '' && $string !== null) {
                $action = $this->new_action($string, $request->name, $request->status);
                $answer->actions()->attach($action->id);
            }
        }
       }
       else{
        $action=$this->new_action($request->description,$request->name,$request->status);
         $answer->actions()->attach($action->id);
        }
        return redirect()->route('action.index',['#q_a_'.$question->id.'_'.$id]);
    }
    public function new_action($name,$description,$status){
        // находим первый уже существующий action с таким же именем и описанием
    $action=Action::where('description',$description)->first();
    // если такого action нет, то создаем новый
    if(!$action)
    {
        $action=new Action;
        $action->name=$name;
        $action->description=$description;
        $action->status=$status;
        $action->user_id=Auth::user()->id;
        $action->save();
    }
        return $action;

    } 
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $answer=Answer::find($id);
        return $answer->actions;
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //

    }
    public function similar(Request $request) {
         ini_set('max_execution_time', 1680);
    if (isset($request->threshold)) {
        $threshold = $request->threshold;
    } else {
        $threshold = 90; // Порог сходства в процентах
    }
    
     $aas = Action::orderBy('id', 'desc')->get();
    $actions = [];
    
    foreach ($aas as $a) {
       $mass_similars = $this->similars($a, $aas, $threshold);
        
        if (count($mass_similars) > 0) {
            $actions[] = [
                'action' => $a,
                'similars' => $mass_similars
            ];
        }
    }
    return $actions;
    return view('action.similar', compact('actions', 'threshold'));
}

public function similars($action, $aas, $threshold) {
    $actions = [];
    
    foreach ($aas as $a) {
        similar_text($action->description, $a->description, $percent);
        
        if ($percent >= $threshold && $a->id !== $action->id) {
            $actions[] = $a->id;
        }
    }
    
    return $actions;
}

}
