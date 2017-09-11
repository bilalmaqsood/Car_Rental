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
            'mileage' => 'numeric',
            'fuel' => 'string|max:50',
            'registration_number' => 'string',
            'mpg' => 'numeric',
            'mpg_eco' => 'numeric',
            'transmission' => 'string|max:255',
            'seats' => 'string|max:50',
            // 'pickup' => 'required|boolean',
            // 'delivery' => 'required|boolean',
            'location' => 'required|string|max:100',
            // 'delivery_charges' => 'required|numeric',
            'rent' => 'required|numeric',
            'insurance' => 'required|numeric',
            // 'mile_cap' => 'required|numeric',
            // 'after_mile' => 'required|numeric',
            // 'deposit' => 'required|numeric',
            // 'extension' => 'numeric',
            // 'license_years' => 'numeric',
            // 'pco_years' => 'numeric',
            // 'driver_year' => 'numeric',
            // 'license_points' => 'numeric',
            // 'no_fault_accident' => 'date_format:Y',
            // 'fault_accident' => 'date_format:Y',

            'discounts' => 'array',
            'discounts.*.percent' => 'numeric',
            'discounts.*.weeks' => 'numeric',

            // 'uber_discount' => 'array',
            // 'uber_discount.*.percent' => 'numeric',
            // 'uber_discount.*.points' => 'numeric',

            'images' => 'array|min:1|required',
            'images.*' => 'string',

            'documents' => 'array',
//            'documents.*.name' => 'string',
//            'documents.*.path' => 'string',
        ];
    }
}
