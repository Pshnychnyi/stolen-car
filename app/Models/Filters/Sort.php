<?php

namespace App\Models\Filters;

use App\Models\Car;
use App\Services\Filters\Filterable;
use Illuminate\Database\Eloquent\Builder;

class Sort implements Filterable
{
    private static array $sort = [
        'id_asc'   => 'asc',
        'id_desc'  => 'desc',
        'name_asc'   => 'asc',
        'name_desc'  => 'desc',
        'number_asc'  => 'asc',
        'number_desc' => 'desc',
        'color_asc'   => 'asc',
        'color_desc'  => 'desc',
        'mark_asc'   => 'asc',
        'mark_desc'  => 'desc',
        'model_asc'   => 'asc',
        'model_desc'  => 'desc',
        'year_asc'   => 'asc',
        'year_desc'  => 'desc',
    ];
    public static function apply(Builder $builder, $value = 'id'): Builder
    {

        if(!array_key_exists($value, self::$sort)) {
            $value = 'id_asc';
        }

        $orderBy = self::$sort[$value];

        $value = substr($value, 0, strpos($value, '_'));

        return $builder->orderBy($value, $orderBy);
    }
}
