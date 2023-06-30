<?php

namespace App\Http\Requests\Cars\Api;

use App\Services\Requests\ApiRequest;
use Illuminate\Contracts\Validation\ValidationRule;


class CarsRequest extends ApiRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|min:2|max:255',
            'number' => 'required|min:2|max:255',
            'color' => 'required|min:2|max:255',
            'vin' => 'required|min:2|max:255',
        ];
    }
}
