<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;
    public $fillable = [
        'content',
        'user_id',
        'is_correct',
    ];
   public $table='answers';
    public function question()
    {
        return $this->belongsTo(Question::class,'question_answer', 'question_id','answer_id');
    }
    public function projects()
    {
        return $this->belongsToMany(Project::class, 'project_answer', 'answer_id', 'project_id')
                    ->withPivot('question_id', 'result')
                    ->withTimestamps();
    }

}
