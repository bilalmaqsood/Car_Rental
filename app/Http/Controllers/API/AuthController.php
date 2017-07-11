<?php

namespace Qwikkar\Http\Controllers\API;

use Illuminate\Http\Request;
use Qwikkar\Http\Controllers\Controller;
use Qwikkar\Models\User;

class AuthController extends Controller
{
    /**
     * Get all information of Authenticated user
     *
     * @param Request $request
     * @return array
     */
    public function info(Request $request)
    {
        return api_response(array_merge($this->userProfile($request->user()), [
            'type' => $request->user()->types->first()->name,
            'accounts' => $request->user()->account,
            'credit_cards' => $request->user()->creditCard,
        ]));
    }

    /**
     * Get all user information according to type
     *
     * @param User $user
     * @return array
     */
    protected function userProfile(User $user)
    {
        $userArray = $user->toArray();

        $profile = [];
        if ($user->isClient())
            $profile = $user->client ? $user->client->toArray() : [];
        else if ($user->isOwner())
            $profile = $user->owner ? $user->owner->toArray() : [];

        return array_merge($userArray, $profile);
    }

    /**
     * Logout Authenticated user and remove all tokens of that user.
     *
     * @param Request $request
     * @return array
     */
    public function updateDeviceID(Request $request)
    {
        $this->validate($request, [
            'device_id' => 'required|string'
        ]);

        $request->user()->device_id = $request->device_id;
        $request->user()->save();

        return api_response(trans('auth.device', ['name' => $request->user()->name]));
    }
}
