<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    use HasFactory;
    //$table
        public $table='topics';
        protected $fillable = [
        'title',
        'anatation',
    ];
    // projects belongs to many topic
    public function projects()
    {
        return $this->belongsToMany(Project::class, 'project_topic' , 'topic_id' ,'project_id');
    }
    // risks belongs to many topic
    public function risks()
    {
        return $this->belongsToMany(Risk::class, 'topic_risk' , 'topic_id' ,'risk_id');
    }
}
