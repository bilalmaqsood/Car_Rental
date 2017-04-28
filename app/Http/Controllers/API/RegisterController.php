<?php

namespace Qwikkar\Http\Controllers\API;

use Illuminate\Http\Request;
use Qwikkar\Http\Controllers\Controller;
use Qwikkar\Http\Requests\UserModel;
use Qwikkar\Models\Client;
use Qwikkar\Models\Owner;
use Qwikkar\Models\User;

class RegisterController extends Controller
{
    /**
     * All user types for register app user
     */
    protected $userTypes = [
        'client',
        'owner'
    ];

    /**
     * RegisterController constructor.
     *
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        if (!in_array($request->type, $this->userTypes)) abort(404);
    }

    /**
     * Register the user according to its type
     *
     * @param UserModel $request
     * @param string $type
     * @param User $user
     * @return array
     */
    public function index(UserModel $request, $type, User $user)
    {
        switch ($type) {
            case 'client':
                return $this->registerClient($request, $user);
                break;
            case 'owner':
                return $this->registerOwner($request, $user);
                break;
        }

        return abort(404);
    }

    /**
     * Register the client
     *
     * @param UserModel $request
     * @param User $user
     * @return array
     */
    protected function registerClient(UserModel $request, User $user)
    {
        $this->validate($request, [
            'insurance' => 'string',
            'postcode' => ['Regex:/^([Gg][Ii][Rr] 0[Aa]{2})|((([A-Za-z][0-9]{1,2})|(([A-Za-z][A-Ha-hJ-Yj-y][0-9]{1,2})|(([A-Za-z][‌​0-9][A-Za-z])|([A-Za-z][A-Ha-hJ-Yj-y][0-9]?[A-Za-z])))) [0-9][A-Za-z]{2})$/'],
            'driving' => 'string',
            'dvla' => 'string',
            'dob' => 'date',
            'pco_release_date' => 'date',
            'pco_expiry_date' => 'date',
            'pco_number' => 'string',
        ], ['postcode.regex' => 'The postcode is invalid.']);

        $user->fill($request->all());
        $user->save();

        $user->addType(3);

        $client = new Client();

        $client->fill($request->all());

        $user->client()->save($client);

        return api_response($user->createToken('APIAccessToken')->accessToken);
    }

    /**
     * Register the owner
     *
     * @param UserModel $request
     * @param User $user
     * @return array
     */
    protected function registerOwner(UserModel $request, User $user)
    {
        $this->validate($request, [
            'company' => 'string',
            'address' => 'string',
            'street' => 'string',
            'town' => 'string',
            'country' => 'string',
            'postcode' => ['Regex:/^([Gg][Ii][Rr] 0[Aa]{2})|((([A-Za-z][0-9]{1,2})|(([A-Za-z][A-Ha-hJ-Yj-y][0-9]{1,2})|(([A-Za-z][‌​0-9][A-Za-z])|([A-Za-z][A-Ha-hJ-Yj-y][0-9]?[A-Za-z])))) [0-9][A-Za-z]{2})$/'],
        ], ['postcode.regex' => 'The postcode is invalid.']);

        $user->fill($request->all());
        $user->save();

        $user->addType(2);

        $owner = new Owner();

        $owner->fill($request->all());

        $user->owner()->save($owner);

        return api_response($user->createToken('APIAccessToken')->accessToken);
    }
}
