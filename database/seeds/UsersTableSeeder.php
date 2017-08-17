<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        \DB::table('users')->insert(array (
            array (
                'id' => 1,
                'name' => 'Qwikkar Application',
                'email' => 'hello@qwikkar.co.uk',
                'phone' => '+442037145675',
                'password' => bcrypt('password123'),
                'device_id' => NULL,
                'avatar' => NULL,
                'postcode' => NULL,
                'remember_token' => NULL,
                'created_at' => '2017-08-11 13:05:53',
                'updated_at' => '2017-08-11 13:05:53',
            ),
            array (
                'id' => 2,
                'name' => 'Mike',
                'email' => 'owner21@hi.com',
                'phone' => '+442074960950',
                'password' => bcrypt('password123'),
                'device_id' => NULL,
                'avatar' => NULL,
                'postcode' => 'cv5 6fg',
                'remember_token' => NULL,
                'created_at' => '2017-08-11 16:57:23',
                'updated_at' => '2017-08-17 11:34:54',
            ),
            array (
                'id' => 3,
                'name' => 'owner',
                'email' => 'owner@qwikkar.com',
                'phone' => '+447704587452',
                'password' => bcrypt('password123'),
                'device_id' => NULL,
                'avatar' => 'http://qwikkar.srhive.com/storage/images/UlC2PMkRDbjgqrSYlMUd2KdECqBdXR9QxCQEEW2K.png',
                'postcode' => NULL,
                'remember_token' => NULL,
                'created_at' => '2017-08-11 17:19:59',
                'updated_at' => '2017-08-16 19:43:23',
            ),
            array (
                'id' => 4,
                'name' => 'loco',
                'email' => 'driver21@hi.com',
                'phone' => '+442074960950',
                'password' => bcrypt('password123'),
                'device_id' => NULL,
                'avatar' => NULL,
                'postcode' => 'cv3 4gh',
                'remember_token' => NULL,
                'created_at' => '2017-08-15 12:15:27',
                'updated_at' => '2017-08-17 11:56:51',
            ),
            array (
                'id' => 5,
                'name' => 'Owner Test',
                'email' => 'owner10@hi.com',
                'phone' => '+442037145688',
                'password' => bcrypt('password123'),
                'device_id' => '',
                'avatar' => '/path/to/image',
                'postcode' => 'EC1A 1BB',
                'remember_token' => NULL,
                'created_at' => '2017-08-15 15:45:41',
                'updated_at' => '2017-08-15 17:47:20',
            ),
            array (
                'id' => 6,
                'name' => 'Driver',
                'email' => 'driver@qwikkar.com',
                'phone' => '+447704578985',
                'password' => bcrypt('password123'),
                'device_id' => NULL,
                'avatar' => NULL,
                'postcode' => 'TD9 5ZN',
                'remember_token' => NULL,
                'created_at' => '2017-08-16 09:30:24',
                'updated_at' => '2017-08-16 09:30:24',
            ),
            array (
                'id' => 7,
                'name' => 'shahzad owner',
                'email' => 'owner@hi.com',
                'phone' => '+443333333333',
                'password' => bcrypt('password123'),
                'device_id' => NULL,
                'avatar' => NULL,
                'postcode' => 'AB22 0AB',
                'remember_token' => NULL,
                'created_at' => '2017-08-16 11:20:36',
                'updated_at' => '2017-08-16 18:52:22',
            ),
            array (
                'id' => 8,
                'name' => 'shahzad driver',
                'email' => 'driver@hi.com',
                'phone' => '+443333333333',
                'password' => bcrypt('password123'),
                'device_id' => NULL,
                'avatar' => NULL,
                'postcode' => 'AB2 0AB',
                'remember_token' => NULL,
                'created_at' => '2017-08-16 17:45:52',
                'updated_at' => '2017-08-16 17:45:52',
            ),
            array (
                'id' => 9,
                'name' => 'owner',
                'email' => 'owner22@hi.com',
                'phone' => '+442074960950',
                'password' => bcrypt('password123'),
                'device_id' => '',
                'avatar' => NULL,
                'postcode' => 'cv4 3gh',
                'remember_token' => NULL,
                'created_at' => '2017-08-17 11:45:12',
                'updated_at' => '2017-08-17 11:54:50',
            )
        ));
    }
}