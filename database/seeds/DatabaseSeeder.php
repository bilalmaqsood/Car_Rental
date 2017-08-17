<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserTypesTable::class);
        $this->call(UsersTableSeeder::class);
        $this->call(UserMappingsTableSeeder::class);

        $this->call(ClientsTableSeeder::class);
        $this->call(OwnersTableSeeder::class);

        $this->call(VehiclesTableSeeder::class);
        $this->call(TimeSlotsTableSeeder::class);
        $this->call(ContractTemplatesTableSeeder::class);

        $this->call(FaqsTableSeeder::class);
        $this->call(PromoCodesTableSeeder::class);
        $this->call(NotificationsTableSeeder::class);
    }
}
