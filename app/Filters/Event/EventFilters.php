<?php

namespace App\Filters\Event;

use App\Filters\FiltersAbstract;
use App\Category;

class EventFilters extends FiltersAbstract
{
    protected $filters = [
        'access' => AccessFilter::class,
        'cat' => CategoryFilter::class,
        'q' => QueryFilter::class,
    ];

    public static function mappings()
    {
        return [
            // 'access' => [
            //     'paid' => 'Paid',
            //     'free' => 'Free'
            // ],
            'cat' => Category::get()->pluck('name', 'slug')
        ];
    }
}
