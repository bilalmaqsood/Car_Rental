<?php

namespace Qwikkar\Concerns;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Qwikkar\Models\Booking;
use Qwikkar\Models\Inspection;
use Qwikkar\Models\ReturnVehicle;
use Qwikkar\Models\Ticket;
use Qwikkar\Models\User;
use Qwikkar\Notifications\DisputeOpenedNotify;
use Ramsey\Uuid\Uuid;

trait Disputable
{
    /**
     * Open dispute and send ticket and emails to both users and admin.
     *
     * @param Request $request
     * @param Booking $booking
     * @param Inspection $inspection
     */
    protected function openDispute(Request $request, Booking $booking, Inspection $inspection)
    {
        $ticket = new Ticket();

        $uuid = (string)Uuid::uuid4();

        $ticket->id = $uuid;

        $ticket->title = $booking->vehicle->vehicle_name . ' \'s dispute opened' . ' - ' . '#' . $uuid;

        $ticket->user()->associate($request->user());

        $ticket->client()->associate($booking->user);

        $inspection->ticket()->save($ticket);

        $users = collect([])
            ->push(User::find(1))
            ->push($booking->user)
            ->push($booking->vehicle->owner->user);

        Notification::send($users, new DisputeOpenedNotify((object)[
            'subject' => $ticket->title,
            'booking' => $booking,
              'data'  => [
            'id' => $booking->id,
            'type' => 'Booking',
            'status' => VEHICLE_DISPUTED,
            'old_status' => $booking->status,
            'vehicle_id' => $booking->vehicle->id,
            'image' => $booking->vehicle->images->first(),
            'title' => "Booking disputed",
            'user' => request()->user()->name,
            'vehicle' => $booking->vehicle->vehicle_name,
            'contract_start' => $booking->start_date,
            'contract_end' => $booking->end_date,
                  ]
        ]));
    }
}