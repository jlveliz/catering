<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RolesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(SettingsTableSeeder::class);
        $this->call(WorkplacesTableSeeder::class);
        $this->call(EmployeesTableSeeder::class);
        $this->call(CustomerTableSeeder::class);
        $this->call(IdentificationTypeTableSeeder::class);
    }
}
