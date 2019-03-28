<?php

namespace App\Filters\Event;

use App\Filters\FiltersAbstract;


class EventFilters extends FiltersAbstract
{
    protected $filters = [
        'access' => AccessFilter::class,
        'cat' => CategoryFilter::class,
        // 'q' => QueryFilter::class,
    ];
}
