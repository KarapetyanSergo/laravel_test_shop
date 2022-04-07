<?php

namespace App\Filters\Rules;

use App\Filters\FilterRule;
use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;

class RelationRule implements FilterRule
{
    private $column;
    private $relationship;

    public function __construct($modelColumn, $relationship)
    {
        $this->column = $modelColumn;
        $this->relationship = $relationship;
    }

    public function filter(Builder $query, $value): Builder
    {
        $relationship = $this->relationship;

         return $query->whereHas($relationship, function (Builder $query) use ($value) {
             $query->where($this->column, '=', $value);
         });
    }
}
