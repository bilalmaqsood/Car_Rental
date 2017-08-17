<?php

use Illuminate\Database\Seeder;

class OwnersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        \DB::table('owners')->insert(array (
            array (
                'id' => 1,
                'user_id' => 2,
                'company' => NULL,
                'street' => NULL,
                'address' => NULL,
                'town' => NULL,
                'postcode' => 'cv5 6fg',
                'country' => NULL,
                'created_at' => '2017-08-11 16:57:23',
                'updated_at' => '2017-08-11 16:57:23',
            ),
            array (
                'id' => 2,
                'user_id' => 3,
                'company' => NULL,
                'street' => NULL,
                'address' => NULL,
                'town' => NULL,
                'postcode' => NULL,
                'country' => NULL,
                'created_at' => '2017-08-11 17:19:59',
                'updated_at' => '2017-08-11 17:19:59',
            ),
            array (
                'id' => 3,
                'user_id' => 5,
                'company' => 'company',
                'street' => '2',
                'address' => '54',
                'town' => 'garden',
                'postcode' => 'EC1A 1BB',
                'country' => 'UK',
                'created_at' => '2017-08-15 15:45:41',
                'updated_at' => '2017-08-15 15:45:41',
            ),
            array (
                'id' => 4,
                'user_id' => 7,
                'company' => 'sdafasdfsaf',
                'street' => 'asfsadf',
                'address' => 'fsdfsdfs',
                'town' => NULL,
                'postcode' => 'AB22 0AB',
                'country' => NULL,
                'created_at' => '2017-08-16 11:20:36',
                'updated_at' => '2017-08-16 18:52:22',
            ),
            array (
                'id' => 5,
                'user_id' => 9,
                'company' => NULL,
                'street' => NULL,
                'address' => NULL,
                'town' => NULL,
                'postcode' => 'cv4 3gh',
                'country' => NULL,
                'created_at' => '2017-08-17 11:45:12',
                'updated_at' => '2017-08-17 11:45:12',
            ),
        ));
    }
}