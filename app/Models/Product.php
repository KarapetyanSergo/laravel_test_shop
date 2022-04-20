<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Product extends Model
{
    use HasFactory;

    const PRODUCT_SIZES = [
        'S',
        'M',
        'L',
        'XS',
        'XL',
        'XXL'
    ];

    const PRODUCT_COLORS = [
        'Red',
        'Blue',
        'Green',
        'Orange',
        'White',
        'Black',
        'Yellow',
        'Purple',
        'Silver',
        'Brown'
    ];

    protected $fillable = [
        'size',
        'color',
        'price',
        'category_id'
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    public function orders(): BelongsToMany
    {
        return $this->belongsToMany(Order::class);
    }

    public function availabilities(): HasMany
    {
        return $this->hasMany(ProductAvailabilities::class);
    }
}
