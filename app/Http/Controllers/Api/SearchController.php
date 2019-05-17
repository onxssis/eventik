<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Event;
use App\Http\Resources\SearchResource;
use App\Filters\Event\EventFilters;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        return new SearchResource(
            Event::with('categories')->filter($request)->paginate(15)
        );
    }

    public function filters()
    {
        return response()->json([
            'data' => EventFilters::mappings()
        ], 200);
    }
}
