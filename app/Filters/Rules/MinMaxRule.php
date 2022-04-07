<?php

namespace App\Filters\Rules;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class MinMaxRule implements FilterRule
{
    private $colimn;

    public function __construct($column)
    {
        $this->colimn = $column;
    }

    public function filtration(Builder $query, Collection $filterParameters): Builder
    {
        return $query->where([
            [$this->colimn, '>=', $filterParameters->all()['min']],
            [$this->colimn, '<=', $filterParameters->all()['max']]
        ]);
    }
}
