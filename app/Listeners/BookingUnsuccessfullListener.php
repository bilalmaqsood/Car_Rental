<?php

namespace Qwikkar\Listeners;

use Qwikkar\Events\BookingUnsuccessfull;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Qwikkar\Notifications\BookingNotify;

class BookingUnsuccessfullListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  BookingUnsuccessfull  $event
     * @return void
     */
    public function handle(BookingUnsuccessfull $event)
    {
        $this->notifyUser($event->booking);

    }

    protected function notifyUser($booking)
    {
        $driver = $booking->user;
        $owner = $booking->vehicle->owner->user;
        $data = [
            'id' => $booking->id,
            'type' => 'Booking request unsuccessfull',
            'status' => BOOKING_UNSUCCESSFULL,
            'old_status' => $booking->status,
            'vehicle_id' => $booking->vehicle->id,
            'image' => $booking->vehicle->images->first(),
//            'title' => 'Booking unsuccessfull',
//            'user' => $owner->name,
//            'requested_data'  => $requestData,
//            'note' => $log->requested_note,
//            'credit_card' => $booking->account?$booking->account->last_numbers:'',
            'vehicle' => $booking->vehicle->vehicle_name,
//            'contract_start' => $booking->start_date,
//            'contract_end' => $booking->end_date,
        ];
        $driver->notify(new BookingNotify($data));
        $owner->notify(new BookingNotify($data));

        
        $booking->timeslots()->update(["status" => 1, "booking_id" => null]);

        $booking->delete();

        return ture;
    }

}
