<?php

namespace Qwikkar\Concerns;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Qwikkar\Models\Booking;
use Qwikkar\Models\ReturnVehicle;
use Qwikkar\Models\Ticket;
use Qwikkar\Models\User;
use Qwikkar\Notifications\DisputeOpenedNotify;

trait Disputable
{
    /**
     * Open dispute and send ticket and emails to both users and admin.
     *
     * @param Request $request
     * @param ReturnVehicle $returnVehicle
     */
    protected function openDispute(Request $request, Booking $booking, ReturnVehicle $returnVehicle)
    {
        $ticket = new Ticket();

        $uuid = str_random();

        $ticket->id = $uuid;

        $ticket->title = $booking->vehicle->vehicle_name . ' \'s dispute opened' . ' - ' . '#' . $uuid;

        $ticket->user()->associate($request->user());

        $returnVehicle->ticket()->save($ticket);

        $users = collect([])
            ->push(User::find(1))
            ->push($booking->user)
            ->push($booking->vehicle->owner->user);

        Notification::send($users, new DisputeOpenedNotify((object)[
            'subject' => $ticket->title,
            'booking' => $booking
        ]));
    }
}