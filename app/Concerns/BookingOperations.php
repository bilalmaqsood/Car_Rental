<?php

namespace Qwikkar\Concerns;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Qwikkar\Models\BalanceLog;
use Qwikkar\Models\Booking;
use Qwikkar\Models\BookingLog;
use Qwikkar\Models\BookingPayment;
use Qwikkar\Models\User;
use Qwikkar\Models\Vehicle;

trait BookingOperations
{
    /**
     * Generate list of dates between two dates
     *
     * @param $start
     * @param $end
     * @return array
     */
    protected function generateDateRange($start, $end)
    {
        $start = Carbon::parse($start);
        $end = Carbon::parse($end);

        $dates = [];

        for ($date = $start; $date->lte($end); $date->addDay()) {
            $dates[] = $date->format('Y-m-d');
        }

        return $dates;
    }

    /**
     * Start the booking of provided Vehicle
     *
     * @param Request $request
     * @param Vehicle $vehicle
     * @return array|\Illuminate\Http\JsonResponse
     */
    protected function proceedToBooking(Request $request, Vehicle $vehicle)
    {
        $booking = Booking::firstOrNew($request->all());

        $booking->deposit = $vehicle->deposit;

        $booking->vehicle()->associate($vehicle);
        $booking->user()->associate($request->user());

        $booking->save();

        Couponize::processPromoCode($booking, $request);

        $this->deductDeposit($booking, $request);

        return api_response($booking->fresh(['vehicle' => function ($with) {
            $with->select('id', 'make', 'model', 'variant', 'year', 'deposit', 'images');
        }]));
    }

    /**
     * Validate booking according to user type
     *
     * @param Booking $booking
     * @param Request $request
     */
    protected function deductDeposit(Booking $booking, Request $request)
    {
        $user = $request->user();

        if ($user->current_balance < $booking->deposit)
            $this->makePaymentFromCard($user, $booking->deposit);

        // deduct deposit from balance
        $user->balance->current -= $booking->deposit;
        $user->balance->save();

        // add booking payment log
        $payment = new BookingPayment([
            'title' => 'Deposit',
            'cost' => $booking->deposit,
            'due_date' => $booking->start_date,
            'paid' => 1,
        ]);
        $booking->payments()->save($payment);

        // add first week rent
        $rent = $booking->vehicle->rent;
        if (count($booking->vehicle->discounts))
            foreach ($booking->vehicle->discounts as $discount) {
                if ($discount['week'] == 1)
                    $rent -= (100 + $discount['percent']) / 100;
            }
        $booking->payments()->create([
            'title' => 'Week 1',
            'cost' => $rent,
            'due_date' => $booking->start_date->addWeek()
        ]);

        // add log of balance of deposit deduction
        $balanceLog = new BalanceLog([
            'amount' => $booking->deposit,
            'comment' => 'deduct payment for booking deposit',
        ]);
        $balanceLog->balance()->associate($user->balance);
        $payment->balanceLogs()->save($balanceLog);
    }

    /**
     * Validate booking according to user type
     *
     * @param User $user
     * @param float $amount
     */
    protected function makePaymentFromCard(User $user, $amount)
    {
        if (!$user->balance) {
            $user->balance()->create(['current' => 0]);
            $user->load('balance');
        }

        $user->addBalance($amount);
    }

    /**
     * Validate booking according to user type
     *
     * @param Booking $booking
     * @param Request $request
     * @return bool
     */
    protected function validateBooking(Booking $booking, Request $request)
    {
        return (
            ($request->user()->isOwner() && $request->user()->id !== $booking->vehicle->owner->user->id) ||
            ($request->user()->isClient() && $request->user()->id !== $booking->user->id)
        );
    }

    /**
     * Update a booking with slots
     *
     * @param Request $request
     * @param Booking $booking
     * @return array|\Illuminate\Http\JsonResponse
     */
    protected function updateBooking(Request $request, Booking $booking)
    {
        $booking->fill($request->all());
        $booking->save();

        return api_response($booking->fresh(['vehicle' => function ($with) {
            $with->select('id', 'make', 'model', 'variant', 'year', 'deposit');
        }]));
    }

    /**
     * Update a booking against booking log
     *
     * @param BookingLog $log
     */
    protected function updateBookingFromLog(BookingLog $log)
    {
        $booking = $log->booking;

        $booking->fill($log->requested_data);

        if (isset($log->requested_data['start_date']) || isset($log->requested_data['end_date'])) {
            $booking->status = 6;
        } elseif ($log->requested_data['status'] == 3) {
            $booking->status = 4;
        }

        $booking->save();
    }

    /**
     * get notification string for requested data
     *
     * @param BookingLog $log
     * @return \Illuminate\Contracts\Translation\Translator|string
     */
    protected function getStatusNotifyString(BookingLog $log)
    {
        $booking = $log->booking;
        $data = $log->requested_data;

        if (isset($data['start_date']) || isset($data['end_date'])) {
            $status = 5;
        } else {
            $status = $data['status'];
        }

        $booking->status = $status;
        $booking->save();

        return trans('booking.requested', [
            'user' => $log->requested->name,
            'status' => strtolower($booking->statusTypes[$status])
        ]);
    }

    /**
     * get notification string for requested data
     *
     * @param BookingLog $log
     * @return \Illuminate\Contracts\Translation\Translator|string
     */
    protected function getFulfillNotifyString(BookingLog $log)
    {
        $booking = $log->booking;

        return trans('booking.fulfilled', [
            'user' => $log->fulfilled->name,
            'status' => strtolower($booking->statusTypes[$booking->status])
        ]);
    }
}