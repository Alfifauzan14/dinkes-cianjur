<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PpidPermohonan extends Model
{
    protected $fillable = [
        'token',
        'nama_pemohon',
        'nik',
        'no_hp',
        'email',
        'pekerjaan',
        'cara_memperoleh',
        'cara_informasi',
        'bentuk_informasi',
        'alamat',
        'foto_ktp',
        'jenis_informasi',
        'tujuan_penggunaan',
        'rincian_informasi',
        'alasan_permohonan',
        'format_informasi',
        'status',
        'tanggapan',
        'file_tanggapan',
    ];

    protected $casts = [
        'format_informasi' => 'array',
    ];

    /**
     * The "booted" method of the model.
     */
    protected static function booted()
    {
        static::creating(function ($model) {
            if (empty($model->token)) {
                $model->token = static::generateUniqueToken();
            }
        });
    }

    /**
     * Generate a unique 7-digit numeric token.
     */
    public static function generateUniqueToken(): string
    {
        do {
            $token = sprintf('%07d', random_int(0, 9999999));
        } while (static::where('token', $token)->exists());

        return $token;
    }

    public function keberatans(): HasMany
    {
        return $this->hasMany(PpidKeberatan::class, 'permohonan_id');
    }
}
