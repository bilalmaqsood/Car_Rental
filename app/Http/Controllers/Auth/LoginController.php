<?php

namespace Qwikkar\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Qwikkar\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Qwikkar\Models\User;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    /**
     * Validate the user login request.
     *
     * @param  \Illuminate\Http\Request $request
     * @return void
     */
    protected function validateLogin(Request $request)
    {
        $this->validate($request, [
            $this->username() => 'required|string',
            'password' => 'required|string',
            'device_id' => 'string'
        ]);
    }

    /**
     * Send the response after the user was authenticated.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    protected function sendLoginResponse(Request $request)
    {
        if ($request->hasSession())
            $request->session()->regenerate();

        $this->clearLoginAttempts($request);

        return $this->authenticated($request, $this->guard()->user())
            ?: redirect()->intended($this->redirectPath());
    }

    /**
     * The user has been authenticated.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  mixed $user
     * @return mixed
     */
    protected function authenticated(Request $request, $user)
    {
        return $request->expectsJson() ?
            $this->setAPIResponse($request, $user) :
            redirect()->intended($this->redirectPath());
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
     * Set token for api and response
     *
     * @param  \Illuminate\Http\Request $request
     * @param  mixed $user
     * @return mixed
     */
    protected function setAPIResponse(Request $request, $user)
    {
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

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        if ($request->hasSession()) {
            $this->guard()->logout();
            $request->session()->flush();
            $request->session()->regenerate();
        } else {
            $request->user()->tokens()->delete();
            $request->user()->device_id = '';
            $request->user()->save();
        }

        return $request->expectsJson() ?
            api_response(trans('auth.logout', ['name' => $request->user()->name])) :
            redirect('/');
    }
}
