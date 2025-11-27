<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class ResearchProject extends Model
{
    use HasFactory;

    protected $fillable = [
        'brand_id',
        'title',
        'slug',
        'focus_area',
        'summary',
        'content',
        'partners',
        'status',
        'meta',
    ];

    protected $casts = [
        'partners' => 'array',
        'meta' => 'array',
    ];

    protected static function booted(): void
    {
        static::creating(function (ResearchProject $project) {
            if (blank($project->slug)) {
                $project->slug = Str::slug($project->title) . '-' . Str::random(6);
            }
        });
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
