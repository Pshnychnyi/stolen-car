<?php
/**
 * Created by PhpStorm.
 * User: note
 * Date: 01.02.2021
 * Time: 22:47
 */

namespace App\Models\Filters;

use App\Models\Car;
use App\Services\Filters\BaseSearch;
use App\Services\Filters\Searchable;

class CarsSearch implements Searchable
{
    const MODEL = Car::class;
    use BaseSearch;
}
