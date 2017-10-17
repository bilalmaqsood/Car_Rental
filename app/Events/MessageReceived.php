<?php

namespace Qwikkar\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Support\Collection;
use Qwikkar\Models\Message;
use Qwikkar\Models\User;

class MessageReceived implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Message
     *
     * @var Message
     */
    public $message;

    /**
     * User
     *
     * @var User
     */
    public $sender;

    /**
     * User
     *
     * @var User
     */
    public $receiver;

    /**
     * Create a new event instance.
     *
     * @param Message $message
     * @param array $sender
     * @param integer $id
     */
    public function __construct(Message $message, User $receiver, User $sender)
    {
        $this->receiver = $receiver;
        $this->message = $message;
        $this->sender = $sender;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new PresenceChannel('user-' . $this->receiver->id);
    }
}
