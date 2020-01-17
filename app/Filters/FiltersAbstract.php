<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

abstract class FiltersAbstract
{
    protected $request;

    protected $filters = [];

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function filter(Builder $builder)
    {
        foreach ($this->getFilters() as $filterKey => $filterValue) {
            $this->resolveFilters($filterKey)->filter($builder, $filterValue);
        }

        return $builder;
    }

    public function append(array $filters)
    {
        $this->filters = array_merge($this->filters, $filters);

        return $this;
    }

    protected function getFilters()
    {
        return $this->excludeFilters($this->filters);
    }

    protected function resolveFilters($filter)
    {
        return new $this->filters[$filter]();
    }

    protected function excludeFilters($filters)
    {
        return array_filter($this->request->only(array_keys($filters)));
    }
}
