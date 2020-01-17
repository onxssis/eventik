<?php

namespace App\Filters\Event;

use App\Filters\SingleFilterAbstract;
use App\Helpers\Queries;
use Illuminate\Database\Eloquent\Builder;

class LocationFilter extends SingleFilterAbstract
{
    public function filter(Builder $builder, $key)
    {
        return Queries::getEventsNearby($builder, $key, '<=', 10000, 0);
    }
}
