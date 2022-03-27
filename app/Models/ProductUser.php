<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class ProductUser extends Pivot
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product_id'
    ];
}
