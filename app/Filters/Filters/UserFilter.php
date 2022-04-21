<?php

namespace App\Filters\Filters;

use App\Filters\Filter;
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
}
