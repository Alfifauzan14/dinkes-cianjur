<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramKesehatan extends Model
{
    use HasFactory;

    protected $table = 'program_kesehatans';

    protected $fillable = [
        'title',
        'slug',
        'kategori',
        'icon',
        'subtitle',
        'stat_1_num',
        'stat_1_label',
        'stat_2_num',
        'stat_2_label',
        'stat_3_num',
        'stat_3_label',
        'content',
        'intervensi',
        'status',
    ];

    protected $casts = [
        'intervensi' => 'array',
    ];
}
