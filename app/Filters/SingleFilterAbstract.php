<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;


abstract class SingleFilterAbstract
{
    abstract public function filter(Builder $builder, $filterKey);

    public function mappings()
    {
        return [];
    }

    protected function resolveFilterValue($filterKey)
    {
        return array_get($this->mappings(), $filterKey);
    }

}