<?php

namespace Qwikkar\Channels;

use GuzzleHttp\Client;
use Illuminate\Notifications\Notification;

class PushNotificationAndroid
{
    /**
     * Send the given notification.
     *
     * @param  mixed $notifiable
     * @param  \Illuminate\Notifications\Notification $notification
     * @return void
     */
    public function send($notifiable, Notification $notification)
    {
        if ($notifiable->device_id)
            $this->android(
                $notifiable->device_id,
                $notification->toAndroid($notifiable)
            );
    }

    /**
     * push notification to android
     *
     * @param $device
     * @param $data
     */
    protected function android($device, $data)
    {
        $client = new Client();

        $client->post('https://fcm.googleapis.com/fcm/send', [
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                'Authorization' => 'key=' . config('services.android.key')
            ],
            'json' => [
                'to' => $device,
                'data' => $data
            ]
        ]);
    }
}