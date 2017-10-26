<?php

namespace Qwikkar\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Qwikkar\Channels\PushNotificationAndroid;

class DisputeOpenedNotify extends Notification
{
    use Queueable;

    /**
     * Options to notify
     *
     * @var array
     */
    protected $options = [];

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
     * @param  mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        // return ['mail','database',PushNotificationAndroid::class];
        return ['database',PushNotificationAndroid::class];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject($this->options->subject)
            ->line('Booking Started At: ' . $this->options->booking->start_date->toFormattedDateString())
            ->line('Booking Ended At: ' . $this->options->booking->end_date->toFormattedDateString())
            ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed $notifiable
     * @return array
     */
    public function toAndroid($notifiable)
    {
        return $this->options->data;
    }
    /**
     * Get the array representation of the notification.
     *
     * @param  mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return (array) $this->options->data;
    }
}
