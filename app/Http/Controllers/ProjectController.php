<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Topic;
use App\Models\Risk;
use App\Models\Answer;
use Illuminate\Support\Facades\Auth;
class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $user_id=Auth::id();
        $projects = Project::where('user_id','=',$user_id)->get();
        return view('project.index',compact('projects'));
     }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('project.create');
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
        $project = new Project;
        $project->title = $request->title;
        $project->anatation = $request->anatation;
        $project->user_id = Auth::id();
        $project->save();
        // show
        return redirect()->route('project.show',$project->id);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $project = Project::find($id);
       // $risks= Risk::where('under_id','=',0)->get();
        $topics = Topic::orderBy ('id','desc')->get();
        return view('project.show',compact('project','topics'));
    }
    public function risk(string $id,string $topic){
            $project = Project::find($id);
            if($topic!==0){
                $project->topics()->detach();
                $project->topics()->attach($topic);
            }
           $tpc =$project->topics()->first()->risks;
           return view('project.risk',compact('project','tpc','topic'));
      }
      // count_risk
      public function count_risk(Request $request, string $id){
          $project = Project::find($id);
          $project->risks()->detach();
          $project->risks()->attach($request->risks);
          $project->questions()->detach();
          foreach($request->risks as $risk){
              $riskModel = Risk::find($risk);
              foreach($riskModel->questions as $question){
                  $project->questions()->attach($question);
              }
          }
          return redirect()->route('project.reaction',$project->id);
      }
  public function reaction(Request $request, string $id)
{   $project = Project::find($id);

    if (isset($request->answers)) {
        $json = $request->answers;
        $question = $request->question_id;
        
        $data = json_decode($json, true);

        foreach ($data as $item) {
            $ida = $item['id'];
            $v = $item['v'];
            if($v==null)$v=0;

            // Проверяем, существует ли запись с указанным id и question_id
            $existingAnswer = $project->answers()->where('answer_id', $ida)->where('question_id', $question)->first();

            if ($existingAnswer) {
                // Запись уже существует, обновляем значение поля result
                $existingAnswer->pivot->result = $v;
                $existingAnswer->pivot->save();
            } else {
                // Запись не существует, создаем новую запись с указанными значениями
                $project->answers()->attach($ida, ['question_id' => $question, 'result' => $v]);
            }
        }
        // if trim answer !=='' add new Answer and attach to question_id
        $answer_content = $request->answer;
        if(trim($answer_content)!==''){
        $answer = new  Answer;
        $answer->content = $answer_content;
        $answer->user_id   = Auth::id();
        $answer->is_correct = 0;
        $answer->save();
        }
    }

    $page = $request->input('page', 1);
    $questions = $project->questions()->paginate(1, ['*'], 'page', $page);
    $answers = $questions->first()->answers()
    ->where(function ($query) {
        $query->where('is_correct', 1)
            ->orWhere(function ($query) {
                $query->where('is_correct', 0)
                    ->where('user_id', Auth::id());
            });
    })
    ->get();
    // если не последняя страница 
    if($page < $questions->lastPage()) {
        return view('project.reaction', compact('project', 'questions', 'answers'));
    } else {
       return view('project.action', compact('project'));
    }
    
}
public function action(Request $request,string $id){
   $project=Project::find($id);
   return  view('project.action',compact('project'));
}


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $project = Project::find($id);
        return view('project.edit',compact('project'));                                                                                               
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
       // return  $request->anatation;
        $project = Project::find($id);
        $project->title = $request->title;
        $project->anatation = $request->anatation;
        $project->people =$request->people;
        $project->budget =$request->budget;
        $project->timeDays =$request->timeDays;
        $project->risk =0;
        $project->save();

         return redirect()->route('project.show',$project->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $project = Project::find($id);
        $project->delete();
        return redirect()->route('project.index');
    }
}
