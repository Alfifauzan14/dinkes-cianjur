<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'date',
        'time_start',
        'time_end',
        'location',
        'description',
        'status',
    ];

    protected $casts = [
        'date' => 'date',
    ];

    /**
     * Scope a query to only include published and active (date <= today) agendas.
     *
     * @param  Builder  $query
     * @return Builder
     */
    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    /**
     * Determine if the agenda is published but scheduled in the future (pending).
     */
    public function isPending(): bool
    {
        return $this->status === 'published' && $this->date->isFuture();
    }
}
