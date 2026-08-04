<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'kepala_dinas_name',
        'kepala_dinas_role',
        'sambutan_title',
        'sambutan_quote',
        'sambutan_desc_1',
        'sambutan_desc_2',
        'kepala_dinas_image',
        'sejarah_title',
        'sejarah_text_1',
        'sejarah_text_2',
        'sejarah_image',
        'struktur_organisasi_image',
        'visi_title',
        'visi_desc',
        'stat_1_text',
        'stat_2_text',
        'misi',
    ];

    protected $casts = [
        'misi' => 'array',
    ];
}
