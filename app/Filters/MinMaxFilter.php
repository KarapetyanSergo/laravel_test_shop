<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class MinMaxFilter implements Filter
{
    private $colimn;

    public function __construct($column)
    {
        $this->colimn = $column;
    }

    public function filtration(Builder $query, Collection $value): Builder
    {
        return $query->where([
            [$this->colimn, '>=', $value->all()['min']],
            [$this->colimn, '<=', $value->all()['max']]
        ]);
    }
}
