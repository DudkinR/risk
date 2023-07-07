<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;
public $table='questions';
    protected $fillable = [
        'under_id',
        'content',
        'positive',
    ];
    public function under()
    {
        return $this->belongsTo(Question::class, 'under_id');
    }
    public function risks()
    {
        return $this->belongsToMany(Risk::class, 'risk_question', 'risk_id', 'question_id');
    }
    public function answers()
    {
        return $this->belongsToMany(Answer::class,'question_answer', 'question_id','answer_id');
    }

}
