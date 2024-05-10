<?php

namespace App\Filters;

use Illuminate\Http\Request;

class PropertyFilters extends QueryFilters
{
    protected $request;
    public function __construct(Request $request)
    {
        $this->request = $request;
        parent::__construct($request);
    }

    public function name($term)
    {
        return $this->builder->where('name', 'LIKE', "%$term%");
    }

    public function bathrooms($term)
    {
        return $this->builder->where('bathrooms', $term);
    }

    public function bedrooms($term)
    {
        return $this->builder->where('bedrooms', $term);
    }

    public function garages($term)
    {
        return $this->builder->where('garages', $term);
    }

    public function storeys($term)
    {
        return $this->builder->where('storeys', $term);
    }

    public function minPrice($term)
    {
        return $this->builder->where('price', '>=', $term);
    }

    public function maxPrice($term)
    {
        return $this->builder->where('price', '<=', $term);
    }
}
