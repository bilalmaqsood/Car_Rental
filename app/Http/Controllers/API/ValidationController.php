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
        response()->json(['success' => 'success'], 200);
    }

}
