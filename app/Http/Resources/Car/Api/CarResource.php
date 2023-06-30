<?php

namespace App\Http\Resources\Car\Api;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CarResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'number' => $this->number,
            'color' => $this->color,
            'make' => new MakeResource($this->make),
            'model' => new ModelResource($this->model),
            'year' => $this->year,
            'created' => Carbon::parse($this->created_at)->format('d.m.Y'),

        ];
    }
}
