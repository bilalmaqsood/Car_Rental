<?php

namespace Qwikkar\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Qwikkar\Http\Controllers\Controller;
use Qwikkar\Models\User;

class AuthController extends Controller
{
    /**
     * Get all notifications of Authenticated user
     *
     * @param Request $request
     * @return array
     */
    public function notifications(Request $request)
    {
        return api_response($request->user()->unreadNotifications);
    }

    /**
     * Update notification's read date of Authenticated user
     *
     * @param Request $request
     * @return array
     */
    public function notificationsRead(Request $request)
    {
        $notification = $request->user()->notifications()->where('id', $request->notify_id)->first();

        if ($notification)
            $notification->update(['read_at' => \Carbon\Carbon::now()]);

        return api_response(trans('auth.readed'));
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
            $profile = $user->client ? $user->client->toArray() : [];
        else if ($user->isOwner())
            $profile = $user->owner ? $user->owner->toArray() : [];

        return array_merge($userArray, $profile);
    }

    /**
     * Change password of user
     *
     * @param Request $request
     * @return array|\Illuminate\Http\JsonResponse
     */
    protected function changePassword(Request $request)
    {
        $this->validate($request, [
            'current' => 'required|min:6',
            'password' => 'required|min:6|confirmed',
        ]);

        if (!Hash::check($request->current, $request->user()->password))
            return api_response(trans('passwords.current'), Response::HTTP_UNPROCESSABLE_ENTITY);

        $request->user()->password = $request->password;
        $request->user()->save();

        return api_response(trans('passwords.change'));
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
