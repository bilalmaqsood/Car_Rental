<?php

use Illuminate\Database\Seeder;

class UserMappingsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        \DB::table('user_mappings')->insert(array (
            array (
                'user_id' => 1,
                'user_type_id' => 1,
            ),
            array (
                'user_id' => 2,
                'user_type_id' => 2,
            ),
            array (
                'user_id' => 3,
                'user_type_id' => 2,
            ),
            array (
                'user_id' => 4,
                'user_type_id' => 3,
            ),
            array (
                'user_id' => 5,
                'user_type_id' => 2,
            ),
            array (
                'user_id' => 6,
                'user_type_id' => 3,
            ),
            array (
                'user_id' => 7,
                'user_type_id' => 2,
            ),
            array (
                'user_id' => 8,
                'user_type_id' => 3,
            ),
            array (
                'user_id' => 9,
                'user_type_id' => 2,
            ),
        ));
    }
}