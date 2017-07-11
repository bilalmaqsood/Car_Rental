<?php

namespace Qwikkar\Http\Controllers\api;

use Illuminate\Http\Request;
use Qwikkar\Http\Controllers\Controller;

class WithdrawController extends Controller
{
    /**
     * WithdrawController constructor.
     */
    public function __construct()
    {
        $this->middleware('owner');
    }

    /**
     * Withdraw amount for owner earnings
     *
     * @param Request $request
     * @return array|\Illuminate\Http\JsonResponse
     */
    public function __invoke(Request $request)
    {
        if ($request->user()->current_balance >= $request->amount) {

        }

        return api_response($request->all());
    }
}
