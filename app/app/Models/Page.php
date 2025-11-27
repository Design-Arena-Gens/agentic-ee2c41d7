<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Page extends Model
{
    use HasFactory;

    protected $fillable = [
        'brand_id',
        'slug',
        'title',
        'tagline',
        'template',
        'hero_title',
        'hero_subtitle',
        'hero_image',
        'sections',
        'content',
        'meta',
        'is_active',
    ];

    protected $casts = [
        'sections' => 'array',
        'meta' => 'array',
        'is_active' => 'boolean',
    ];

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }
}
