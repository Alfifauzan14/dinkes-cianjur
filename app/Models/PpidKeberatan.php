<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PpidKeberatan extends Model
{
    protected $fillable = [
        'permohonan_id',
        'token',
        'email',
        'alasan_keberatan',
        'status',
        'tanggapan_admin',
        'file_tanggapan',
    ];

    public function permohonan(): BelongsTo
    {
        return $this->belongsTo(PpidPermohonan::class, 'permohonan_id');
    }
}
