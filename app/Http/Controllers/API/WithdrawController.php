<?php

namespace Qwikkar\Http\Controllers\api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Qwikkar\Http\Controllers\Controller;
use Qwikkar\Models\BalanceLog;
use Qwikkar\Models\Withdraw;

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
        $this->validate($request, [
            'amount' => 'required|numeric',
            'note' => 'string'
        ]);

        if ($request->user()->current_balance < $request->amount)
            return api_response(trans('withdraw.insufficient'), Response::HTTP_PAYMENT_REQUIRED);

        $withdraw = new Withdraw($request->all());

        $request->user()->withdraw()->save($withdraw);

        $balanceLog = new BalanceLog([
            'amount' => $request->amount,
            'comment' => $request->note
        ]);

        $balanceLog->balance()->associate($request->user()->balance);

        $withdraw->balanceLogs()->save($balanceLog);

        $request->user()->balance->current -= $request->amount;

        $request->user()->balance->save();

        return api_response($withdraw);
    }
}
