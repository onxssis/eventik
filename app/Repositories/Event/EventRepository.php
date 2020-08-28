<?php

namespace App\Repositories\Event;

interface EventRepository
{
    public function getUpcomingEvents($limit = 5);

    public function getFeaturedEvents($limit = 5);

    public function getPastEvents($limit = 5);
}
