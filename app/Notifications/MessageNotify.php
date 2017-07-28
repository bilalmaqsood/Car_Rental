<?php

namespace Qwikkar\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Qwikkar\Channels\PushNotificationAndroid;

class MessageNotify extends Notification
{
    use Queueable;

    /**
     * Options for push notification
     *
     * @var array
     */
    protected $options;

    /**
     * Create a new notification instance.
     *
     * @param $options
     */
    public function __construct($options)
    {
        $this->options = $options;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [PushNotificationAndroid::class];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed $notifiable
     * @return array
     */
    public function toAndroid($notifiable)
    {
        return $this->options;
    }
}
