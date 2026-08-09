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
        'total_balita',
        'balita_stunting',
        'wilayah_terendah',
        'wilayah_tertinggi',
        'catatan',
        'is_highlighted',
    ];

    protected $casts = [
        'is_highlighted' => 'boolean',
        'balita_stunting' => 'integer',
    ];
}
