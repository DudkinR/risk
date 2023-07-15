<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anketa extends Model
{
    use HasFactory;
   protected $table = 'anketas';
    protected $fillable = [
        'qw',
        'description',
        'img_id',
    ];
    public function answs()
    {
        return $this->belongsToMany(Anketaansw::class,'anketa_anketaansws','anketa_id','anketaansw_id');
    }
    // image
   /* public function img()
    {
        return $this->morphOne(Img::class, 'img_id');
    }      */

}
