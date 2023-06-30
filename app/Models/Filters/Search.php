<?php

namespace App\Models\Filters;

use App\Services\Filters\Filterable;
use Illuminate\Database\Eloquent\Builder;

class Search implements Filterable
{

    public static function apply(Builder $builder, $value): Builder
    {
        return $builder->where(function ($query) use ($value) {
            $query->where('name', 'like', '%' . $value . '%')
                ->orWhere('number', 'like', '%' . $value . '%')
                ->orWhere('vin', 'like', '%' . $value . '%');
        });
    }
}
