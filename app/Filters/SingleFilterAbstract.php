<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;

abstract class SingleFilterAbstract
{
    abstract public function filter(Builder $builder, $filterKey);

    public function mappings()
    {
        return [];
    }

    protected function resolveFilterValue($filterKey)
    {
        return Arr::get($this->mappings(), $filterKey);
    }

}