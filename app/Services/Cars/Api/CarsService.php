<?php

namespace App\Services\Cars\Api;

use App\Models\Car;
use App\Models\Filters\CarsSearch;
use App\Models\Make;
use App\Models\Model;
use App\Services\Response\ResponseService;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CarsService
{

    protected string $baseUrl = 'https://vpic.nhtsa.dot.gov/api';



    public function getCars(Request $request, CarsSearch $carsSearch): LengthAwarePaginator
    {
        $cars = $carsSearch->apply($request)->paginate(config('settings.pagination'))->appends(request()->input());
        return $cars;
    }




    public function save(Request $request, Car $car): JsonResponse|Car
    {
        $car->fill($request->only($car->getFillable()));

        if(!$request->vin) {
            return ResponseService::sendJsonResponse('false', 404, [
                'item' => 'The Car not found'
            ], []);
        }

        if(!$item = $this->getCarByVin($request->vin)) {
            return ResponseService::sendJsonResponse('false', 404, [
                'item' => 'Vin is not valid'
            ], []);
        }

        $model = Model::where('Model_ID', $item['Results'][0]['ModelID'])->firstOrFail();
        $make = Make::where('Make_ID', $item['Results'][0]['MakeID'])->firstOrFail();

        $car->model()->associate($model);
        $car->make()->associate($make);
        $car->year = $item['Results'][0]['ModelYear'];

        $car->save();

        return $car;
    }


    public function getModelsByMake($make)
    {
        return Model::where('Make_Name', 'LIKE', '%' . $make . '%')->get();
    }


    public function getCarByVin($vin)
    {
        $response = Http::get("{$this->baseUrl}/vehicles/DecodeVinValues/{$vin}?format=json");

        if ($response->successful()) {
            return $response->json();
        }

        return false;
    }



}


