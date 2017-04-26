<?php

use Illuminate\Database\Seeder;

class UserTypesTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_types')->insert([
            ['name' => 'admin'],
            ['name' => 'owner'],
            ['name' => 'client'],
        ]);

        DB::table('user_mappings')->insert([
            'user_id' => 1,
            'user_type_id' => 1
        ]);
    }
}
