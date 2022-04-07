<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

interface Filter
{
    public function filtration(Builder $query, Collection $value): Builder;
}
