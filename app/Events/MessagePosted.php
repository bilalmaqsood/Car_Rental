<?php

namespace Qwikkar\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Qwikkar\Models\Message;
use Qwikkar\Models\User;

class MessagePosted implements ShouldBroadcast
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
     * @param User $receiver
     * @param User $sender
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
        return new PresenceChannel('chatroom');
    }
}
