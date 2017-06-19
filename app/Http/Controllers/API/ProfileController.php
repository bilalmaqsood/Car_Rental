<?php

namespace Qwikkar\Http\Controllers\API;

use Illuminate\Http\Request;
use Qwikkar\Http\Controllers\Controller;

class ProfileController extends Controller
{
    /**
     * update client profile
     *
     * @param Request $request
     * @return array
     */
    protected function updateClient(Request $request)
    {
        $this->validate($request, [
            'first_name' => 'alpha',
            'last_name' => 'alpha',
            'email' => 'email|unique:users,email',
            'phone' => 'phone:GB',

            'postcode' => [
                'Regex:/^([Gg][Ii][Rr] 0[Aa]{2})|((([A-Za-z][0-9]{1,2})|(([A-Za-z][A-Ha-hJ-Yj-y][0-9]{1,2})|(([A-Za-z][‌​0-9][A-Za-z])|([A-Za-z][A-Ha-hJ-Yj-y][0-9]?[A-Za-z])))) [0-9][A-Za-z]{2})$/'
            ],

            'insurance' => 'string',
            'driving' => 'string',
            'dvla' => 'string',
            'dob' => 'date',
            'pco_release_date' => 'date',
            'pco_expiry_date' => 'date',
            'pco_number' => 'string',
        ]);

        $user = $request->user();

        $user->fill($request->all());
        $user->save();

        $client = $user->client;

        $client->fill($request->all());

        $client->save();

        return api_response(trans('auth.profile'));
    }

    /**
     * update owner profile
     *
     * @param Request $request
     * @return array
     */
    protected function updateOwner(Request $request)
    {
        $this->validate($request, [
            'first_name' => 'alpha',
            'last_name' => 'alpha',
            'email' => 'email|unique:users,email',
            'phone' => 'phone:GB',

            'postcode' => [
                'Regex:/^([Gg][Ii][Rr] 0[Aa]{2})|((([A-Za-z][0-9]{1,2})|(([A-Za-z][A-Ha-hJ-Yj-y][0-9]{1,2})|(([A-Za-z][‌​0-9][A-Za-z])|([A-Za-z][A-Ha-hJ-Yj-y][0-9]?[A-Za-z])))) [0-9][A-Za-z]{2})$/'
            ],

            'company' => 'string',
            'address' => 'string',
            'street' => 'string',
            'town' => 'string',
            'country' => 'string',
        ]);

        $user = $request->user();

        $user->fill($request->all());
        $user->save();

        $owner = $user->owner;

        $owner->fill($request->all());

        $owner->save();

        return api_response(trans('auth.profile'));
    }
}
