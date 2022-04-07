<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Builder;

abstract class Filter
{
    abstract public function rules(): Collection;

    public function handle(array $filters, Builder $query): Builder
    {
        foreach ($filters as $key => $filter) {
            $query = $this->rules()->all()[$key]->filtration($query, Collection::make($filter));
        }

        return $query;
    }
}
