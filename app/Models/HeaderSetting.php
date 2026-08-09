<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HeaderSetting extends Model
{
    use HasFactory;

    protected $fillable = ['page_key', 'page_name', 'title', 'subtitle'];

    public static function getByKey(string $key, string $defaultTitle = '', string $defaultSubtitle = ''): self
    {
        return self::firstOrCreate(
            ['page_key' => $key],
            [
                'page_name' => ucwords(str_replace('-', ' ', $key)),
                'title' => $defaultTitle,
                'subtitle' => $defaultSubtitle,
            ]
        );
    }
}
