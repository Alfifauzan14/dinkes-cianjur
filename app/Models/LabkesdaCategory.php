<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class LabkesdaCategory extends Model
{
    protected $fillable = [
        'title',
        'description',
        'badge_text',
        'button_text',
        'button_url',
        'icon_name',
        'order_index',
    ];

    public function items(): HasMany
    {
        return $this->hasMany(LabkesdaItem::class, 'labkesda_category_id')->orderBy('order_index');
    }
}
