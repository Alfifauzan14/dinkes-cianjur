<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Regulasi extends Model
{
    protected $fillable = [
        'title',
        'category',
        'topic',
        'description',
        'year',
        'cover_path',
        'file_path',
        'file_size',
        'status',
    ];
}
