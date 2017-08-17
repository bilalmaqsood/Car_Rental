<?php

use Illuminate\Database\Seeder;

class NotificationsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        \DB::table('notifications')->insert(array (
            array (
                'id' => '1e5b4d93-dfc7-407e-9c0a-c0539d66cd38',
                'type' => 'Qwikkar\\Notifications\\UserNotify',
                'notifiable_id' => 8,
                'notifiable_type' => 'Qwikkar\\Models\\User',
                'data' => '{"title":"Welcome to Qwikkar"}',
                'read_at' => NULL,
                'created_at' => '2017-08-16 17:45:52',
                'updated_at' => '2017-08-16 17:45:52',
            ),
            array (
                'id' => '28af52f1-e9ca-45b5-918c-e7e58f474e4e',
                'type' => 'Qwikkar\\Notifications\\UserNotify',
                'notifiable_id' => 5,
                'notifiable_type' => 'Qwikkar\\Models\\User',
                'data' => '{"title":"Welcome to Qwikkar"}',
                'read_at' => NULL,
                'created_at' => '2017-08-15 15:45:41',
                'updated_at' => '2017-08-15 15:45:41',
            ),
            array (
                'id' => '3974bbb8-bbbf-4878-8a37-1a9279947c8d',
                'type' => 'Qwikkar\\Notifications\\UserNotify',
                'notifiable_id' => 3,
                'notifiable_type' => 'Qwikkar\\Models\\User',
                'data' => '{"title":"Welcome to Qwikkar"}',
                'read_at' => NULL,
                'created_at' => '2017-08-11 17:19:59',
                'updated_at' => '2017-08-11 17:19:59',
            ),
            array (
                'id' => '7eda7e74-a218-4b48-ac1f-6c92bba7faff',
                'type' => 'Qwikkar\\Notifications\\UserNotify',
                'notifiable_id' => 2,
                'notifiable_type' => 'Qwikkar\\Models\\User',
                'data' => '{"title":"Welcome to Qwikkar"}',
                'read_at' => NULL,
                'created_at' => '2017-08-11 16:57:23',
                'updated_at' => '2017-08-11 16:57:23',
            ),
            array (
                'id' => '83e21b36-fbdd-4c10-aed2-f571fbd30f09',
                'type' => 'Qwikkar\\Notifications\\UserNotify',
                'notifiable_id' => 9,
                'notifiable_type' => 'Qwikkar\\Models\\User',
                'data' => '{"title":"Welcome to Qwikkar"}',
                'read_at' => NULL,
                'created_at' => '2017-08-17 11:45:12',
                'updated_at' => '2017-08-17 11:45:12',
            ),
            array (
                'id' => 'c149ab92-fcd0-41b1-9552-8e01125a8c1b',
                'type' => 'Qwikkar\\Notifications\\UserNotify',
                'notifiable_id' => 7,
                'notifiable_type' => 'Qwikkar\\Models\\User',
                'data' => '{"title":"Welcome to Qwikkar"}',
                'read_at' => NULL,
                'created_at' => '2017-08-16 11:20:36',
                'updated_at' => '2017-08-16 11:20:36',
            ),
            array (
                'id' => 'cc8b1ffb-a856-4cb5-a84e-dba9de3489c4',
                'type' => 'Qwikkar\\Notifications\\UserNotify',
                'notifiable_id' => 6,
                'notifiable_type' => 'Qwikkar\\Models\\User',
                'data' => '{"title":"Welcome to Qwikkar"}',
                'read_at' => NULL,
                'created_at' => '2017-08-16 09:30:24',
                'updated_at' => '2017-08-16 09:30:24',
            ),
            array (
                'id' => 'd8ec06f2-183f-445b-b9a5-770f4dd24d36',
                'type' => 'Qwikkar\\Notifications\\UserNotify',
                'notifiable_id' => 4,
                'notifiable_type' => 'Qwikkar\\Models\\User',
                'data' => '{"title":"Welcome to Qwikkar"}',
                'read_at' => NULL,
                'created_at' => '2017-08-15 12:15:27',
                'updated_at' => '2017-08-15 12:15:27',
            ),
        ));
    }
}