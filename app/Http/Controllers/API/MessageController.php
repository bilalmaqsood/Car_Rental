<?php

namespace Qwikkar\Http\Controllers\API;

use Illuminate\Http\Request;
use Qwikkar\Events\MessagePosted;
use Qwikkar\Events\MessageReceived;
use Qwikkar\Http\Controllers\Controller;
use Qwikkar\Models\Booking;
use Qwikkar\Models\Message;
use Qwikkar\Models\User;
use Qwikkar\Models\Vehicle;
use Qwikkar\Notifications\MessageNotify;

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
     * Get all messages of a booking
     *
     * @param $id
     * @return array|\Illuminate\Http\JsonResponse
     */
    public function getMessages($id)
    {
        return api_response(Booking::findOrFail($id)->messages()->orderBy('updated_at', 'desc')->with('receiver', 'sender')->paginate(10));
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

        if($request->has("receiver_id"))
        broadcast(new MessageReceived($message, $message->receiver, $message->sender))->toOthers();
        else
        broadcast(new MessagePosted($message, $message->receiver, $message->sender))->toOthers();

        return api_response($message);
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

            $booking->user->notify(new MessageNotify([
                'id' => $booking->id,
                'type' => 'Message',
                'sender' => $request->user(),
                'receiver' => $booking->user,
                'message' => $message->message
            ]));
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

            $booking->vehicle->owner->user->notify(new MessageNotify([
                'id' => $booking->id,
                'type' => 'Message',
                'sender' => $request->user(),
                'receiver' => $booking->vehicle->owner->user,
                'message' => $message->message
            ]));
        } else if($request->has('receiver_id')){

            $receiver = User::find($request->receiver_id);

            if($receiver){
                $message->receiver()->associate($receiver);
                $receiver->notify(new MessageNotify([
                'id' => $message->id,
                'type' => 'Message',
                'sender' => $request->user(),
                'receiver' => $receiver,
                'message' => $message->message
            ]));
            }
        }

        return $message;
    }


    /**
     * Get all messages of a booking
     *
     * @param $id
     * @return array|\Illuminate\Http\JsonResponse
     */
    public function getUserMessages($user_id)
    {
        $target = User::find($user_id)->id;

        $messages = Message::Conversation(request()->user()->id,$target)->orderBy('updated_at', 'desc')->with('receiver', 'sender')->paginate(10);

        return api_response($messages);
    }


    public function getNewMessages($user_id)
    {
        $target = User::find($user_id)->id;

        $messages = Message::where("sender_id",$user_id)->where("receiver_id",request()->user()->id)->where('read',0)->orderBy('updated_at', 'desc');

        $data = $messages->with('receiver', 'sender')->get();

        $messages->update(["read" => 1]);


        return api_response(["data" => $data]);

    }

    /**
     * Get all recent of a booking
     *
     * @param $id
     * @return array|\Illuminate\Http\JsonResponse
     */
    public function getBookingNewMessages($id)
    {
        $messages = Booking::findOrFail($id)->messages()->where('read',0)->orderBy('updated_at', 'desc');

        $data = $messages->with('receiver', 'sender')->get();

        $messages->update(["read" => 1]);


        return api_response(["data" => $data]);

    }


    /**
     * Update user for new socket id
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function setSocket(Request $request)
    {
        $this->validate($request, [
            'socket' => 'required|string',
        ]);

        \Auth::user()->update([
            'socket' => $request->socket
        ]);

        return response()->json(true);
    }
}
