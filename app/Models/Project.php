<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    public $table='projects';
    protected $fillable=[
        'title',
        'anatation',
        'user_id',
        'budget',
        'people',
        'timeDays',
        'risk',
    ];
    // topics belongs to many project
    public function topics()
    {
        return $this->belongsToMany(Topic::class, 'project_topic' , 'project_id' ,'topic_id');
    }
    public function risks()
    {
        return $this->belongsToMany(Risk::class, 'project_risk' , 'project_id' ,'risk_id');
    }
    public function questions(){
        return $this->belongsToMany(Question::class, 'project_question' , 'project_id' ,'question_id');
    }
    public function answers()
    {
        return $this->belongsToMany(Answer::class, 'project_answer', 'project_id', 'answer_id')
                    ->withPivot('question_id', 'result')
                    ->withTimestamps();
    }
public function actions()
    {
        return $this->belongsToMany(Action::class, 'action_project', 'project_id', 'action_id')
                     ->withTimestamps();
    }



}
