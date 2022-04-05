<?php

namespace App\Rules;

use App\Models\Product;
use App\Models\ProductAvailabilities;
use Illuminate\Contracts\Validation\Rule;

class CartRule implements Rule
{
    private $productId;
    private $productSize;

    public function __construct($productId, $productSize)
    {
        $this->productId = $productId;
        $this->productSize = $productSize;
    }

    public function passes($attribute, $value): bool
    {
        if(!$this->productId) {
            return false;
        }

        $availability = ProductAvailabilities::where([
            ['product_id', '=', $this->productId],
            ['size', '=', $this->productSize]
        ])->get()->first();

        if(!$availability || $availability->count - $value < 0) {
            return false;
        }

        return true;
    }

    public function message(): string
    {
        return 'Not so many products.';
    }
}
