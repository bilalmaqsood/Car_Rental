<?php

namespace Qwikkar\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VehicleModel extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'make' => 'required|string|max:50',
            'model' => 'required|string|max:50',
            'variant' => 'required|string|max:50',
            'year' => 'required|date_format:Y|max:50',
            'mileage' => 'required|numeric',
            'fuel' => 'required|string|max:50',
            'mpg' => 'required|string|max:50',
            'transmission' => 'required|string|max:255',
            'seats' => 'required|string|max:50',
            'available_from' => 'required|date',
            'available_to' => 'required|date',
            'pickup' => 'required|boolean',
            'delivery' => 'required|boolean',
            'location' => 'required|string|max:100',
            'delivery_charges' => 'required|numeric',
            'rent' => 'required|numeric',
            'insurance' => 'numeric',
            'mile_cap' => 'numeric',
            'after_mile' => 'numeric',
            'deposit' => 'numeric',
            'extension' => 'numeric',
            'license_years' => 'numeric',
            'pco_years' => 'numeric',
            'driver_year' => 'numeric',
            'license_points' => 'numeric',
            'no_fault_accident' => 'date_format:Y',
            'fault_accident' => 'date_format:Y',

            'discounts' => 'array',
            'discounts.*.percent' => 'numeric',
            'discounts.*.weeks' => 'numeric',

            'uber_discount' => 'array',
            'uber_discount.*.percent' => 'numeric',
            'uber_discount.*.points' => 'numeric',

            'images' => 'array',
            'images.*' => 'string',
        ];
    }
}
