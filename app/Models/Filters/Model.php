<?php
/**
 * Created by PhpStorm.
 * User: note
 * Date: 01.02.2021
 * Time: 22:49
 */

namespace App\Models\Filters;


use App\Services\Filters\Filterable;
use Illuminate\Database\Eloquent\Builder;

class Model implements Filterable
{

    public static function apply(Builder $builder, $value): Builder
    {

        return $builder->whereHas('model', function ($query) use ($value) {
            $query->where('models.Model_ID', $value);
        });
    }
}
