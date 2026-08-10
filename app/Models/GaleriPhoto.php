<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GaleriPhoto extends Model
{
    use HasFactory;

    protected $fillable = [
        'galeri_id',
        'image',
        'is_thumbnail',
        'order',
    ];

    protected $casts = [
        'is_thumbnail' => 'boolean',
        'order' => 'integer',
    ];

    public function galeri(): BelongsTo
    {
        return $this->belongsTo(Galeri::class);
    }

    public function getImageUrlAttribute(): string
    {
        if (file_exists(public_path('uploads/galeri/'.$this->image))) {
            return asset('uploads/galeri/'.$this->image);
        }

        return asset('images/'.$this->image);
    }
}
