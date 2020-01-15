<?php

namespace App\Filters\Event;

use App\Filters\SingleFilterAbstract;
use Illuminate\Database\Eloquent\Builder;

class QueryFilter extends SingleFilterAbstract
{
    public function filter(Builder $builder, $key)
    {
        return $builder->where('title', 'ilike', "%{$key}%")
            ->orWhere('address', 'ilike', "%{$key}%");
    }
}
