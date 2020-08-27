<?php

namespace App\Helpers;

use Illuminate\Support\Facades\DB;
use MStaack\LaravelPostgis\Geometries\Point;

class Queries
{
    public static function getEventsNearby($builder, $point = null, $operator = '<=', $distance = 10000, $limit = 8)
    {
        $location = geoip()->getLocation();

        if (!isset($point)) {
            $point = new Point($location['lat'], $location['lon']);
        } elseif (is_string($point) && !$point instanceof Point) {
            $srid_point = explode(',', $point);

            $point = new Point($srid_point[0], $srid_point[1]);
        }

        $nearByQuery = "*,
            ST_Distance(ST_GeographyFromText('SRID=4326;{$point->toWKT()}'), location) as distance";

        return
            $builder->selectRaw($nearByQuery)
            ->where(
                DB::raw(
                    "ST_Distance(ST_GeographyFromText('SRID=4326;{$point->toWkT()}'), location)"
                ),
                $operator,
                $distance
            )
            // ->where('start_date', '>=', Carbon::today())
            ->limit($limit)
            ->get();
    }
}
