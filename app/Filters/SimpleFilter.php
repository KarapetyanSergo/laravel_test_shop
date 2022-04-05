<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class SimpleFilter implements Filter
{
    private $column;

    public function __construct($column)
    {
        $this->column = $column;
    }

    public function filtration(Model $query, Collection $value): Builder
    {
        return $query->where($this->column, $value);
    }
}
