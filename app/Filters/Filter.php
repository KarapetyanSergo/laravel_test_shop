<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Builder;

abstract class Filter
{
    abstract public function rules(): Collection;

    abstract public function filtration(Array $filters, Builder $query): Builder;

    protected function handle($query)
    {
        if (isset($filters['filters'])) {
            foreach ($filters as $key => $filter) {
                $query = $this->rules()->all()[$key]->filtration($query, Collection::make($filter));
            }
        }

        return $query;
    }
}
