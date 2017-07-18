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
            'name' => 'alpha_spaces',
            'phone' => 'phone:GB',

            'postcode' => [
                'Regex:/^([Gg][Ii][Rr] 0[Aa]{2})|((([A-Za-z][0-9]{1,2})|(([A-Za-z][A-Ha-hJ-Yj-y][0-9]{1,2})|(([A-Za-z][‌​0-9][A-Za-z])|([A-Za-z][A-Ha-hJ-Yj-y][0-9]?[A-Za-z])))) [0-9][A-Za-z]{2})$/'
            ],

            'device_id' => 'string',

            'insurance' => 'string',
            'driving' => 'string',
            'dvla' => 'string',
            'dob' => 'date',
            'pco_release_date' => 'date',
            'pco_expiry_date' => 'date',
            'pco_number' => 'string',
        ]);

        $data = $request->all();
        unset($data['email']);

        $user = $request->user();

        $user->fill($data);
        $user->save();

        $client = $user->client;

        $client->fill($data);

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
            'name' => 'alpha_spaces',
            'phone' => 'phone:GB',

            'postcode' => [
                'Regex:/^([Gg][Ii][Rr] 0[Aa]{2})|((([A-Za-z][0-9]{1,2})|(([A-Za-z][A-Ha-hJ-Yj-y][0-9]{1,2})|(([A-Za-z][‌​0-9][A-Za-z])|([A-Za-z][A-Ha-hJ-Yj-y][0-9]?[A-Za-z])))) [0-9][A-Za-z]{2})$/'
            ],

            'device_id' => 'string',

            'company' => 'string',
            'address' => 'string',
            'street' => 'string',
            'town' => 'string',
            'country' => 'string',
        ]);

        $data = $request->all();
        unset($data['email']);

        $user = $request->user();

        $user->fill($data);
        $user->save();

        $owner = $user->owner;

        $owner->fill($data);

        $owner->save();

        return api_response(trans('auth.profile'));
    }
}
