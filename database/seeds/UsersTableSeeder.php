<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Qwikkar\Models\User::create([
            'name' => 'Qwikkar Application',
            'email' => 'hello@qwikkar.co.uk',
            'phone' => '+442037145675',
            'password' => bcrypt('secret'),
        ]);
    }
}
