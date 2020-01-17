<?php

namespace App\Http\Controllers\Api;

use App\Event;
use App\Filters\Event\EventFilters;
use App\Http\Controllers\Controller;
use App\Http\Resources\SearchResource;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        return new SearchResource(
            Event::with('categories')->filter($request)->paginate(5)
        );
    }

    public function filters()
    {
        return response()->json([
            'data' => EventFilters::mappings(),
        ], 200);
    }
}
