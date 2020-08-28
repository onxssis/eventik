<?php

namespace App\Repositories\Event;

use App\Event;
use Carbon\Carbon;

class EloquentEventRepository implements EventRepository
{
    protected $model;

    public function __construct(Event $model)
    {
        $this->model = $model;
    }

    public function __call($method, $args)
    {
        return call_user_func_array([$this->model, $method], $args);
    }

    public function getFeaturedEvents($limit = 5)
    {
        return $this->model->whereHas('bookmarks')
            ->orWhereHas('reservations')
            ->limit($limit)
            ->orderBy('start_date', 'desc')
            ->get()->shuffle();
    }

    public function getUpcomingEvents($limit = 5)
    {
        return $this->model->where('start_date', '>=', Carbon::today())
            ->limit($limit)
            ->orderBy('start_date', 'desc')
            ->get();
    }
    
    public function getPastEvents($limit = 5)
    {
        return $this->model->where('start_date', '<', Carbon::today())
            ->limit($limit)
            ->orderBy('end_date', 'desc')
            ->get();
    }
}
