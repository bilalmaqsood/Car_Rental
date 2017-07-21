<?php

namespace Qwikkar\Http\Controllers\API;

use Illuminate\Http\Request;
use Qwikkar\Http\Controllers\Controller;
use Qwikkar\Models\Booking;
use Qwikkar\Models\Message;
use Qwikkar\Models\User;
use Qwikkar\Models\Vehicle;

class MessageController extends Controller
{
    /**
     * Get all messages of authenticated user
     *
     * @param Request $request
     * @return array|\Illuminate\Http\JsonResponse
     */
    public function allMessages(Request $request)
    {
        return api_response($request->user()->messages()->where('read', 0)->with('sender')->get());
    }

    /**
     * Mark messages to read
     *
     * @param Request $request
     * @return array|\Illuminate\Http\JsonResponse
     */
    public function markRead(Request $request)
    {
        $this->validate($request, [
            'ids' => 'required|array',
            'ids.*' => 'numeric',
        ]);

        $message = $request->user()->messages()->whereIn('id', $request->ids)->get();

        $message->each(function ($m) {
            $m->read = true;
            $m->save();
        });

        return api_response(trans('messages.marked'));
    }

    /**
     * Send message to user for any specific type
     *
     * @param Request $request
     * @param Message $message
     * @return array|\Illuminate\Http\JsonResponse
     */
    public function sendMessage(Request $request, Message $message)
    {
        $this->validate($request, [
            'message' => 'required|string',
            'vehicle_id' => 'exists:vehicles,id',
            'booking_id' => 'exists:bookings,id',
            'receiver_id' => 'exists:users,id',
        ]);

        $message->message = $request->message;

        $message->sender()->associate($request->user());

        if ($request->user()->isOwner())
            $message = $this->sendMessageToDriver($message, $request);

        else if ($request->user()->isClient())
            $message = $this->sendMessageToOwner($message, $request);

        $message->save();

        return api_response(trans('messages.created', ['name' => $message->receiver->name]));
    }

    /**
     * Send chat message to driver user
     *
     * @param Message $message
     * @param Request $request
     * @return Message
     */
    protected function sendMessageToDriver(Message $message, Request $request)
    {
        if ($request->has('receiver_id')) {
            $user = User::findOrFail($request->receiver_id);

            $message->receiver()->associate($user);
        }

        else if ($request->has('booking_id')) {
            $booking = Booking::findOrFail($request->booking_id);

            $message->able()->associate($booking);

            $message->receiver()->associate($booking->user);
        }

        return $message;
    }

    /**
     * Send chat message to owner user
     *
     * @param Message $message
     * @param Request $request
     * @return Message
     */
    protected function sendMessageToOwner(Message $message, Request $request)
    {
        if ($request->has('vehicle_id')) {
            $vehicle = Vehicle::findOrFail($request->vehicle_id);

            $message->able()->associate($vehicle);

            $message->receiver()->associate($vehicle->owner->user);
        }

        else if ($request->has('booking_id')) {
            $booking = Booking::findOrFail($request->booking_id);

            $message->able()->associate($booking);

            $message->receiver()->associate($booking->vehicle->owner->user);
        }

        return $message;
    }
}
