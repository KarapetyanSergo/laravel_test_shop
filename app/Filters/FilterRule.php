<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

interface FilterRule
{
    public function filtration(Builder $query, Collection $filterParameters): Builder;
}
