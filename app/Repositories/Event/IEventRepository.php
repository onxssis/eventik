<?php

namespace App\Repositories\Event;

interface IEventRepository
{
    public function getUpcomingEvents($limit);

    public function getFeaturedEvents($limit);
}
