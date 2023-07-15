<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anketaansw extends Model
{
    use HasFactory;
    protected $table = 'anketaansws';
    protected $fillable = [
        'answer',
        'result',
        'img_id',
    ];
    public function anketa()
    {
        return $this->belongsToMany(Anketa::class,'anketa_anketaansws','anketaansw_id','anketa_id');
    }
    // image
    public function img()
    {
        return $this->morphOne(Img::class, 'img_id');
    }
}
