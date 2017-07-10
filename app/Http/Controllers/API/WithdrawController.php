<?php

namespace Qwikkar\Http\Controllers\api;

use Illuminate\Http\Request;
use Qwikkar\Http\Controllers\Controller;

class WithdrawController extends Controller
{
    /**
     * Withdraw amount for owner earnings
     *
     * @param Request $request
     * @return array|\Illuminate\Http\JsonResponse
     */
    public function __invoke(Request $request)
    {
        return api_response($request->all());
    }
}
