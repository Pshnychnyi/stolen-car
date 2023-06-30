<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CarsExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

    protected $cars;

    public function __construct($cars)
    {
        $this->cars = $cars;
    }

    public function collection()
    {
         $cars = $this->cars;

         return $cars->map(function ($item) {
            return [
                $item->id,
                $item->name,
                $item->number,
                $item->color,
                $item->vin,
                $item->make,
                $item->model,
                $item->year,
                $item->created_at->format('d.m.Y'),
            ];
         });
    }

    public function headings(): array
    {
        return [
            'ID',
            'Name',
            'License Plate',
            'Color',
            'VIN',
            'Make',
            'Model',
            'Year',
            'Created',
        ];
    }
}
