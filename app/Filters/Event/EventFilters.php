<?php

namespace App\Filters\Event;

use App\Category;
use App\Filters\FiltersAbstract;

class EventFilters extends FiltersAbstract
{
    protected $filters = [
        'access' => AccessFilter::class,
        'cat' => CategoryFilter::class,
        'q' => QueryFilter::class,
        'r' => LocationFilter::class,
    ];

    public static function mappings()
    {
        return [
            'cat' => Category::get()->pluck('name', 'slug'),
        ];
    }
}
