<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

interface FilterRule
{
    public function filter(Builder $query, $value): Builder;
}
