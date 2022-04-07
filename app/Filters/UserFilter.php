<?php

namespace App\Filters;

use App\Filters\Rules\SearchRule;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class UserFilter extends Filter
{
    public function rules(): Collection
    {
        return Collection::make([
            'search' => new SearchRule(['name', 'email']),
        ]);
    }

    public function filtration(array $filters, Builder $query): Builder
    {
        return $this->handle($query);
    }
}
