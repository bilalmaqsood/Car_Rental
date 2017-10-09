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
     * Message sender user
     *
     * @var array
     */
    public $sender;

    /**
     * Channel to broadcast
     *
     * @var integer
     */
    protected $id;

    /**
     * Create a new event instance.
     *
     * @param Message $message
     * @param array $sender
     * @param integer $id
     */
    public function __construct(Message $message, array $sender, $id)
    {
        $this->id = $id;
        $this->sender = $sender;
        $this->message = $message;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new PresenceChannel('user-' . $this->id);
    }
}
