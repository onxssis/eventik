<?php

namespace App\Filters\Event;

use Illuminate\Database\Eloquent\Builder;
use App\Filters\SingleFilterAbstract;


class QueryFilter extends SingleFilterAbstract
{
    public function filter(Builder $builder, $key)
    {
        return $builder->where('title', 'ilike', "%{$key}%");
    }
}
