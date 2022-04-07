<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class SimpleFilter implements Filter
{
    private $column;

    public function __construct($column)
    {
        $this->column = $column;
    }

    public function filtration(Builder $query, Collection $value): Builder
    {
        return $query->where($this->column, $value);
    }
}
