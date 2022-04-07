<?php

namespace App\Filters\Rules;

use App\Filters\FilterRule;
use Illuminate\Database\Eloquent\Builder;

class MinMaxRule implements FilterRule
{
    private $colimn;

    public function __construct($column)
    {
        $this->colimn = $column;
    }

    public function filter(Builder $query, $value): Builder
    {
        return $query->where([
            [$this->colimn, '>=', $value['min']],
            [$this->colimn, '<=', $value['max']]
        ]);
    }
}
