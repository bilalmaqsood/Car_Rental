<?php

namespace Qwikkar\Http\Controllers\API;

use Illuminate\Http\Request;
use Qwikkar\Http\Controllers\Controller;
use Qwikkar\Models\Booking;

class FinancialController extends Controller
{
    /**
     * All payments of a booking per weekly
     *
     * @param $id
     * @return array|\Illuminate\Http\JsonResponse
     */
    public function paymentDetailWeekly($id)
    {
        $booking = Booking::findOrFail($id);

        return api_response($booking->payments);
    }

    /**
     * Earnings of owner
     *
     * @param Request $request
     * @return array|\Illuminate\Http\JsonResponse
     */
    public function incomeDetail(Request $request)
    {
        $total = ['earnings' => 0, 'deposit' => 0, 'available' => 0, 'withdraw' => $request->user()->withdraw()->sum('amount')];
        $vehicles = $request->user()->owner->vehicles;

        $vehicles->each(function ($v) use (&$total) {
            $v->booking->each(function ($b) use (&$total) {
                $b->payments()->where('paid', 1)->get()->each(function ($p) use (&$total) {
                    $total['earnings'] += $p->cost;
                    if ($p->title == 'Deposit')
                        $total['deposit'] += $p->cost;
                });
            });
        });

        $total['available'] = $total['earnings'] - $total['deposit'] - $total['withdraw'] + $request->user()->current_balance;

        return api_response($total);
    }

        /**
     * Current Balance  of driver
     *
     * @param Request $request
     * @return array|\Illuminate\Http\JsonResponse
     */
    public function balanceDetails(Request $request)
    {
        return api_response($request->user()->balance->current);
    }
}
