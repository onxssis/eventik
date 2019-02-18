<?php

namespace App\Filters\Event;

use App\Filters\SingleFilterAbstract;


class AccessFilter extends SingleFilterAbstract
{
    public function mappings()
    {
        return [
            'paid' => 'paid',
            'free' => 'free',
        ];
    }

    public function filter($builder, $key)
    {
        $value = $this->resolveFilterValue($key);

        return $value ? ($value === 'paid' ? $builder->where('price', '>', 0) : $builder->where('price', 0)) : $builder;
    }
}