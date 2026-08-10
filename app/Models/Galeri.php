<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Galeri extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'image',
        'category',
    ];

    protected static function booted(): void
    {
        static::creating(function (Galeri $galeri) {
            if (empty($galeri->slug)) {
                $galeri->slug = Str::slug($galeri->title);
            }
            $galeri->image = $galeri->image ?? '';
        });

        static::updating(function (Galeri $galeri) {
            if ($galeri->isDirty('title') && ! $galeri->isDirty('slug')) {
                $galeri->slug = Str::slug($galeri->title);
            }
        });
    }

    public function photos(): HasMany
    {
        return $this->hasMany(GaleriPhoto::class)->orderBy('order');
    }

    public function thumbnail()
    {
        return $this->hasOne(GaleriPhoto::class)->where('is_thumbnail', true);
    }

    public function getThumbnailUrlAttribute(): string
    {
        $thumb = $this->thumbnail;
        if ($thumb && file_exists(public_path('uploads/galeri/'.$thumb->image))) {
            return asset('uploads/galeri/'.$thumb->image);
        }
        if ($thumb) {
            return asset('images/'.$thumb->image);
        }
        // Fallback to legacy single image
        if ($this->image && file_exists(public_path('uploads/galeri/'.$this->image))) {
            return asset('uploads/galeri/'.$this->image);
        }

        return $this->image ? asset('images/'.$this->image) : '';
    }
}
