<?php

namespace Qwikkar\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Qwikkar\Http\Controllers\Controller;
use Qwikkar\Http\Requests\UserModel;
use Qwikkar\Models\Client;
use Qwikkar\Models\Owner;
use Qwikkar\Models\PromoCode;
use Qwikkar\Models\User;
use Qwikkar\Notifications\UserNotify;

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
        if (!in_array($request->type, $this->userTypes)) abort(Response::HTTP_NOT_FOUND);
    }

    /**
     * Register the user according to its type
     *
     * @param UserModel $request
     * @param string $type
     * @param User $user
     * @return array
     */
    public function __invoke(UserModel $request, $type, User $user)
    {   
        switch ($type) {
            case 'client':
                return $this->registerClient($request, $user);
                break;
            case 'owner':
                return $this->registerOwner($request, $user);
                break;
        }

        return abort(Response::HTTP_NOT_FOUND);
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
            'driving' => 'string',
            'dvla' => 'string',
            'dob' => 'date',
            'pco_release_date' => 'date',
            'pco_expiry_date' => 'date',
            'pco_number' => 'string',
        ]);

        $user->fill($request->all());
        $user->password = bcrypt($request->get("password"));
        $user->save();

        $user->addType(3);

        $client = new Client($request->all());

        $user->client()->save($client);

        PromoCode::processPromoCode($user, $request);

        $this->notifyWelcome($user);

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
        ]);

        $user->fill($request->all());
        $user->password = bcrypt($request->get("password"));
        $user->save();

        $user->addType(2);

        $owner = new Owner($request->all());

        $user->owner()->save($owner);

        PromoCode::processPromoCode($user, $request);

        $this->notifyWelcome($user);

        return api_response($user->createToken('APIAccessToken')->accessToken);
    }

    /**
     * Send notification for new user
     *
     * @param User $user
     */
    protected function notifyWelcome(User $user)
    {
        $user->notify(new UserNotify([
            'title' => 'Welcome to Qwikkar',
             'status' => 200
        ]));
    }
}
