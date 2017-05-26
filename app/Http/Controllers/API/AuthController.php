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
            'password' => 'required'
        ]);

        $user = User::whereEmail($request->email)->wherePassword($request->password)->first();

        if ($user) {
            $user->tokens()->delete();
            return api_response(array_merge($this->userProfile($user), ['token' => $user->createToken('APIAccessToken')->accessToken, 'type' => $user->types->first()->name]));
        }

        return api_response(trans('auth.failed'), 406);
    }

    /**
     * Get all information of Authenticated user
     *
     * @param Request $request
     * @return array
     */
    public function info(Request $request)
    {
        return api_response($this->userProfile($request->user()));
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
        return api_response(trans('auth.logout', ['name' => $request->user()->last_name]));
    }
}
