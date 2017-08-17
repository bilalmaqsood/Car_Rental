<?php

use Illuminate\Database\Seeder;

class PromoCodesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        \DB::table('promo_codes')->insert(array (
            array (
                'id' => 1,
                'code' => 'year2017',
                'reward' => '5.00',
                'is_active' => 1,
                'expire_at' => '2017-08-15 16:52:46',
                'created_at' => '2017-08-11 16:53:54',
                'updated_at' => '2017-08-11 16:53:54',
            ),
        ));
    }
}