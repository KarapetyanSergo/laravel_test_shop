<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class MinMaxFilter implements Filter
{
    private $colimn;

    public function __construct($column)
    {
        $this->colimn = $column;
    }

    public function filtration(Model $query, Collection $value): Builder
    {
        return $query->where([
            [$this->colimn, '>=', $value->all()['min']],
            [$this->colimn, '<=', $value->all()['max']]
        ]);
    }
}
