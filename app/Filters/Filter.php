<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Builder;

abstract class Filter
{
    abstract public function rules(): Collection;

    public function handle(array $parameters, Builder $query): Builder
    {
        foreach ($parameters as $name => $value) {
            $query = $this->rules()->get($name)->filter($query, $value);
        }

        return $query;
    }
}
