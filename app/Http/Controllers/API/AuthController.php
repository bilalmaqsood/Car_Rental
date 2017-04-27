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
            return api_response(['token' => $user->createToken('APIAccessToken')->accessToken, 'type' => $user->types->first()->name]);
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
        $user = $request->user()->toArray();

        $profile = [];
        if ($request->user()->isClient())
            $profile = $request->user()->clinet->toArray();
        else if ($request->user()->isOwner())
            $profile = $request->user()->owner->toArray();

        return api_response(array_merge($user, $profile));
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
