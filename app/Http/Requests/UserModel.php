<?php

namespace Qwikkar\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserModel extends FormRequest
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
            'name' => 'required|alpha_spaces',
            'email' => 'required|email|unique:users,email',
            'phone' => 'phone:GB',
            'password' => 'required|string',

            'postcode' => [
                'required',
                'Regex:/^([Gg][Ii][Rr] 0[Aa]{2})|((([A-Za-z][0-9]{1,2})|(([A-Za-z][A-Ha-hJ-Yj-y][0-9]{1,2})|(([A-Za-z][‌​0-9][A-Za-z])|([A-Za-z][A-Ha-hJ-Yj-y][0-9]?[A-Za-z])))) [0-9][A-Za-z]{2})$/'
            ],

            'promo_code' => 'exists:promo_codes,code',

            'device_id' => 'string',

            'avatar' => 'string',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'postcode.regex' => 'The postcode is invalid.',
        ];
    }
}
