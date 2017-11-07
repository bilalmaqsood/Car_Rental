<?php

namespace Qwikkar\Http\Controllers\API;

use Illuminate\Http\Request;
use Qwikkar\Http\Controllers\Controller;
use Qwikkar\Models\Booking;

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

            'documents' => 'array',
        ]);

        $data = $request->except(['email', 'status', 'dlc']);

        $user = $request->user();

        $user->fill($data);
        $user->save();

        $client = $user->client;

        $client->fill($data);

        $client->documents = $request->documents;

        if ($client->documents && $client->documents->count()) {
            $docs = collect([]);

            $client->documents->each(function ($d) use ($docs) {
                if ((
                    $d['doc'] == 'driving_licence' ||
                    $d['doc'] == 'pco_licence' ||
                    $d['doc'] == 'dbs_certificate' ||
                    $d['doc'] == 'proof_of_address' ||
                    $d['doc'] == 'pco_licence_badge' 
                    ) && isset($d['path']) && filter_var($d['path'], FILTER_VALIDATE_URL) !==false)
                    $docs->push($d['doc']);
            });

            if ($docs->count() == 5)
                $client->dlc = true;
        }

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

        $data = $request->except(['email']);

        $user = $request->user();

        $user->fill($data);
        $user->save();

        $owner = $user->owner;

        $owner->fill($data);

        $owner->save();

        return api_response(trans('auth.profile'));
    }

    public function showProfile($id)
    {
        $booking = Booking::find($id);
        $user = $booking->user()->with("client")->first();
        return api_response($user);

    }
}
