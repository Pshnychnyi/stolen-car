<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Model as CarModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Car extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'number',
        'color',
        'vin',
        'Make_ID',
        'Model_ID'
    ];


    public function model(): BelongsTo
    {
        return $this->belongsTo(CarModel::class, 'model_id', 'Model_ID');
    }

    public function make(): BelongsTo
    {
        return $this->belongsTo(Make::class, 'make_id', 'Make_ID');
    }



}
