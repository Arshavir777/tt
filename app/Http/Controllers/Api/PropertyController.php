<?php

namespace App\Http\Controllers\Api;

use App\Filters\PropertyFilters;
use App\Http\Controllers\Controller;
use App\Models\Property;

class PropertyController extends Controller
{
    public function index(PropertyFilters $filters)
    {
        $properties = Property::filter($filters)
            ->orderBy('price', 'DESC')
            ->get();

        return response()->json($properties);
    }
}
