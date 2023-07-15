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
    public function show(string $id ,Request $request)
    {
        //
        $project = Project::find($id);
        // if has topic
        if($project->topics()->count()>0){
          if($project->risks()->count()>0){
             // return $this->count_all_answers($project->questions);
             if($project->answers()->count()<$this->count_all_answers($project->questions)) {
                $count=[$project->answers()->count(),$this->count_all_answers($project->questions) ];
                $project_id = $project->id;
                $work_qs= $project->answers->pluck('pivot.question_id')->unique();
                // выбрать все вопросы, кроме  $work_qs
                $question = $project->questions()
                    ->whereNotIn('questions.id', $work_qs)
                    ->first();
                $answers = $question->answers()
                ->where(function ($query) {
                    $query->where('is_correct', 1)
                        ->orWhere(function ($query) {
                            $query->where('is_correct', 0)
                                ->where('user_id', Auth::id());
                        });
                })
                ->get();
                return view('project.reaction', compact('project', 'question', 'answers','count'));
             }
             else{

              return $project->answers->where('pivot.result','=',1);
             }
          }
          else{
           //    $qs=$this-> similar($id,$request);
               $tpc =$project->topics()->first()->risks;
               return view('project.risk',compact('project','tpc','topic','qs'));
          }

        }
        else{
            $topics = Topic::orderBy ('id','desc')->get();
            return view('project.show',compact('project','topics'));  
        }
         
    }
    public function count_all_answers($qs){
      //  return  $qs ;
        $count = 0;
        foreach($qs as $q){
            $count += $q->answers()->count();
        }
       return $count;

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
          if($request->risks) {
              $project->risks()->detach();
              $project->risks()->attach($request->risks);
              $project->questions()->detach();
              $project = Project::find($id);
              $questions=$this->similar($id,$request);
                foreach($questions[0] as $question){
                $project->questions()->attach($question['id']);
                }
          };
          return redirect()->route('project.reaction',$project->id);
      }
    public function reaction(Request $request, string $id)
    {
        $project = Project::find($id);
        if(isset($request->answers)) {
            $json = $request->answers;
            $question = $request->question_id;
            $data = json_decode($json, true);
            foreach ($data as $item) {
                $ida = $item['id'];
                $v = $item['v'];
                if($v==null)
                    $v=0;
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
         $project = Project::find($id);
        // return $this->count_all_answers($project->questions);
        if($project->answers()->count()<$this->count_all_answers($project->questions)) {
            $count=[$project->answers()->count(),$this->count_all_answers($project->questions) ];
            $project_id = $project->id;
            $work_qs= $project->answers->pluck('pivot.question_id')->unique();
            // выбрать все вопросы, кроме  $work_qs
            $question = $project->questions()
                ->whereNotIn('questions.id', $work_qs)
                ->first();
            $answers = $question->answers()
            ->where(function ($query) {
                $query->where('is_correct', 1)
                    ->orWhere(function ($query) {
                        $query->where('is_correct', 0)
                            ->where('user_id', Auth::id());
                    });
            })
            ->get();
                return view('project.reaction', compact('project', 'question', 'answers','count'));
        }
        else{
            return redirect()->route('project.show',$project->id);
        }

    }
    public function select_question($project)   {

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
    public function update(Request $request, string $id)      {
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
        $project->topics()->detach();
        $project->risks()->detach();
        $project->questions()->detach();
        $project->answers()->detach();
        $project->actions()->detach();

        $project->delete();
        return redirect()->route('project.index');
    }
    public function reset(string $id)
    {
        $project = Project::find($id);
        $project->topics()->detach();
        $project->risks()->detach();
        $project->questions()->detach();
        $project->answers()->detach();
        $project->actions()->detach();
        return redirect()->route('project.show',$id);
    }
     public function similar(string $id,Request $request) {
        if (isset($request->threshold)) {
            $threshold = $request->threshold;
        } else {
            $threshold = 50; // Порог сходства в процентах
        }
        $project =Project::find($id);
        // выбираем риски для проекта
        $risks=$project->topics->first()->risks;
        $qs=[];    // выбираем вопросы для проекта  risks   risk_question
        foreach($risks as $risk)
        {
            $qs = array_merge($qs, $risk->questions->toArray());
        }
        shuffle($qs);
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
       return   [$non_similar_questions, $threshold] ;
       //   return view('project.show',$id ,compact('non_similar_questions', ''));
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
