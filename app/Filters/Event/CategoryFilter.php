<?php

namespace App\Filters\Event;

use Illuminate\Database\Eloquent\Builder;
use App\Filters\SingleFilterAbstract;


class CategoryFilter extends SingleFilterAbstract
{
    public function filter(Builder $builder, $key)
    {
        return $builder->whereHas('categories', function (Builder $builder) use ($key) {
            return $builder->where('slug', $key);
        });
    }
}
