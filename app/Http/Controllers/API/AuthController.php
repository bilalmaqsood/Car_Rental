<?php

namespace Qwikkar\Http\Controllers\API;

use Illuminate\Http\Request;
use Qwikkar\Http\Controllers\Controller;
use Qwikkar\Models\User;

class AuthController extends Controller
{
    /**
     * Authenticate user and return Bearer Token
     *
     * @param Request $request
     * @return array
     */
    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|exists:users,email',
            'password' => 'required',
            'device_id' => 'string'
        ]);

        d(bcrypt($request->password));
        $user = User::whereEmail($request->email)->first();
        dd($user);

        if ($user) {
            $user->tokens()->delete();

            if ($request->has('device_id')) {
                $user->device_id = $request->device_id;
                $user->save();
            }

            return api_response(array_merge($this->userProfile($user), [
                'token' => $user->createToken('APIAccessToken')->accessToken,
                'type' => $user->types->first()->name,
                'accounts' => $user->account,
                'credit_cards' => $user->creditCard,
            ]));
        }

        return api_response(trans('auth.failed'), 406);
    }

    /**
     * Send reset password link email
     *
     * @param Request $request
     * @return array
     */
    public function forgot(Request $request)
    {
        return api_response($request->all());
    }

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
            $profile = $user->client->toArray();
        else if ($user->isOwner())
            $profile = $user->owner->toArray();

        return array_merge($userArray, $profile);
    }

    /**
     * Logout Authenticated user and remove all tokens of that user.
     *
     * @param Request $request
     * @return array
     */
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        $request->user()->device_id = '';
        $request->user()->save();

        return api_response(trans('auth.logout', ['name' => $request->user()->name]));
    }
}
