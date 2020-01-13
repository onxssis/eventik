<?php

namespace App\Helpers;

use Illuminate\Support\Facades\DB;

class Helpers
{
    public static function eventsNearby()
    {
        $lat = 6.453060;
        $lon = 3.395830;

        // return DB::table('events')
        //     ->select('events.id', DB::raw('6371 * acos(cos(radians('.$lat.'))
        // * cos(radians(events.latitude))
        // * cos(radians(events.longitude) - radians('.$lon.'))
        // + sin(radians('.$lat.'))
        // * sin(radians(events.latitude))) AS distance'))
        //     ->groupBy('events.id')
        //     ->get();
    }
}
