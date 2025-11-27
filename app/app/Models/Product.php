<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'brand_id',
        'name',
        'slug',
        'sku',
        'type',
        'short_description',
        'description',
        'price',
        'sale_price',
        'stock',
        'track_stock',
        'is_active',
        'attributes',
        'shipping_profile',
        'seo',
        'published_at',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'sale_price' => 'decimal:2',
        'track_stock' => 'boolean',
        'is_active' => 'boolean',
        'attributes' => 'array',
        'shipping_profile' => 'array',
        'seo' => 'array',
        'published_at' => 'datetime',
    ];

    protected static function booted(): void
    {
        static::creating(function (Product $product) {
            if (blank($product->slug)) {
                $product->slug = Str::slug($product->name) . '-' . Str::random(6);
            }

            if (blank($product->sku)) {
                $product->sku = strtoupper(Str::random(10));
            }
        });
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(ProductImage::class);
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
