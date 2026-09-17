<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LayananTerpadu extends Model
{
    protected $table = 'layanan_terpadu';

    protected $fillable = [
        'name',
        'type',
        'icon',
        'link',
        'description',
        'requirements',
        'procedures',
        'processing_time',
        'tariff',
        'helpdesk_email',
        'helpdesk_phone',
    ];
}
