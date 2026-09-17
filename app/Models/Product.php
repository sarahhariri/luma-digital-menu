<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable([
    'category_id',
    'name',
    'slug',
    'description',
    'image',
    'price',
    'is_featured',
    'is_active',
    'order',
])]
class Product extends Model
{
    use HasFactory;

    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
        ];
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function sizes(): HasMany
    {
        return $this->hasMany(ProductSize::class)
            ->orderBy('order');
    }

    public function extras(): BelongsToMany
    {
        return $this->belongsToMany(Extra::class)
            ->withTimestamps()
            ->orderBy('extras.order');
    }
}