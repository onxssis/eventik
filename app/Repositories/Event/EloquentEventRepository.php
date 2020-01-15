<?php

namespace App\Repositories\Event;

use App\Event;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Phaza\LaravelPostgis\Geometries\Point;

class EloquentEventRepository implements IEventRepository
{
    protected $event;

    public function __construct(Event $event)
    {
        $this->event = $event;
    }

    public function __call($method, $args)
    {
        return call_user_func_array([$this->event, $method], $args);
    }

    public function getFeaturedEvents($limit = 5)
    {
        return $this->event->whereHas('bookmarks')
            ->orWhereHas('reservations')
            ->limit($limit)
            ->orderBy('start_date', 'desc')
            ->get()->shuffle();
    }

    public function getUpcomingEvents($limit = 5)
    {
        return $this->event->where('start_date', '>=', Carbon::today())
            ->limit($limit)
            ->orderBy('start_date', 'desc')
            ->get()
        ;
    }

    public function getEventsNearby($point = null, $operator = '<=', $distance = 10000, $limit = 8)
    {
        $location = geoip()->getLocation();

        if (!isset($point)) {
            $point = new Point($location['lat'], $location['lat']);
        } elseif (is_string($point) && !$point instanceof Point) {
            $srid_point = explode(',', $point);

            $point = new Point($srid_point[1], $srid_point[0]);
        }

        $nearByQuery = "*,
            ST_Distance(ST_GeographyFromText('SRID=4326;{$point->toWKT()}'), location) as distance";

        return $this->event->selectRaw($nearByQuery)
            ->where(
                DB::raw(
                    "ST_Distance(ST_GeographyFromText('SRID=4326;{$point->toWkT()}'), location)"
                ),
                $operator,
                $distance
            )
            ->where('start_date', '>=', Carbon::today())
            ->limit($limit)
            ->get()
        ;
    }
}
