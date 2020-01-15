<?php

namespace App\Repositories\Event;

interface IEventRepository
{
    public function getUpcomingEvents($limit);

    public function getFeaturedEvents($limit);

    public function getEventsNearby($point = null, $operator = '<=', $distance = 10000, $limit = 8);
}
