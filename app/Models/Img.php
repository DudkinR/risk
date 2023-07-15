<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Img extends Model
{
    use HasFactory;
     // table
    protected $table = 'images';
    // fillables
    protected $fillable = [
        'name',
        'type' ,
        'path',
        'extension',
        'size',
        'height',
        'width',
        'mime_type',
        'url',
        'alt',
        'title',
        'caption',
        'description',
        'user_id',
    ];
    public function calculateSmallWidth()
    {
        return ceil($this->width / 4);
    }

    public function calculateSmallHeight()
    {
        return ceil($this->height / 4);
    }
}
