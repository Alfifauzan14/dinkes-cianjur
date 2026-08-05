<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LabkesdaItem extends Model
{
    protected $fillable = ['labkesda_category_id', 'item_name', 'order_index'];

    public function category(): BelongsTo
    {
        return $this->belongsTo(LabkesdaCategory::class, 'labkesda_category_id');
    }
}
