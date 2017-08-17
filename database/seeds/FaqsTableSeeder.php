<?php

use Illuminate\Database\Seeder;

class FaqsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        \DB::table('faqs')->insert(array (
            array (
                'id' => 1,
                'question' => 'Test',
                'answer' => NULL,
                'answered_by' => NULL,
                'created_at' => '2017-08-16 16:35:06',
                'updated_at' => '2017-08-16 16:35:06',
            ),
            array (
                'id' => 2,
                'question' => 'What is love',
                'answer' => NULL,
                'answered_by' => NULL,
                'created_at' => '2017-08-16 16:35:20',
                'updated_at' => '2017-08-16 16:35:20',
            ),
        ));
    }
}