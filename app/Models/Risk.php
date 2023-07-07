<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Risk extends Model
{
    use HasFactory;
    public $table='risks';
    protected $fillable = [
        'under_id',
        'title',
        'anatation',
    ];
    public function under()
    {
        return $this->belongsTo(Risk::class, 'under_id');
    }
public function questions()
    {
        return $this->belongsToMany(Question::class, 'risk_question', 'risk_id', 'question_id' );
    }

}
