<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StuntingRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'year',
        'rate',
        'is_highlighted',
    ];

    protected $casts = [
        'is_highlighted' => 'boolean',
        'rate' => 'float',
    ];
}
