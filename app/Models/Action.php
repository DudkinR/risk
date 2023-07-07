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




}
