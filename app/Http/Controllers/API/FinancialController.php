<?php

namespace Qwikkar\Http\Controllers\API;

use Illuminate\Http\Request;
use Qwikkar\Http\Controllers\Controller;
use Qwikkar\Models\Booking;

class FinancialController extends Controller
{
    public function paymentDetailWeekly(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);

        $vehicle = $booking->vehicle;

        $balanceLogs = $booking->balanceLogs;

        return api_response($balanceLogs);
    }

    public function incomeDetail(Request $request)
    {
        return api_response($request->all());
    }
}
