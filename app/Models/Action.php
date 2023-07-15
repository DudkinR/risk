<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Action extends Model
{
    use HasFactory;
    // table
    protected $table = 'actions';
    // atributos
    protected $fillable = [
        'name',
        'description',
        'status',
        'user_id'
    ];
    // quesstions belongs to many actions
    public function questions()
    {
        return $this->belongsToMany(Question::class, 'action_question', 'action_id', 'question_id')
                    ->withTimestamps();
    }





}
