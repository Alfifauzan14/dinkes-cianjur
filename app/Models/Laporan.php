<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    protected $fillable = [
        'title',
        'category',
        'file_path',
        'file_size',
        'release_date',
    ];

    protected $casts = [
        'release_date' => 'date',
    ];
}
