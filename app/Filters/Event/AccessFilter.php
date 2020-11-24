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

        if ($value) {

            if ($value === 'paid') {
                $builder->where('price', '>', 0);
            } else {
                $builder->where('price', 0);
            }

            return $builder;

        } else {
            return $builder;
        }
    }
}