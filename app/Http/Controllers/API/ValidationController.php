<?php

namespace Qwikkar\Http\Controllers\API;

use Illuminate\Http\Request;
use Qwikkar\Http\Controllers\Controller;
use Qwikkar\Http\Requests\UserModel;

class ValidationController extends Controller
{

    /**
     * Validate User on Signup .
     *
     * @param Request $request
     */
    public function registerValidate(UserModel $request, $type)
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

        response()->json(['success' => 'success'], 200);
    }

}
