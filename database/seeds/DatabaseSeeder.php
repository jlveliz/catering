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
        $this->call(PaymentMethodTableSeeder::class);
        $this->call(WorkplacesTableSeeder::class);
        $this->call(EmployeesTableSeeder::class);
        $this->call(CustomerTableSeeder::class);
        $this->call(IdentificationTypeTableSeeder::class);
        $this->call(CustomerContractTableSeeder::class);
        $this->call(CustomerContractDetailTableSeeder::class);
        $this->call(ProviderTableSeeder::class);
        $this->call(ProductTypeTableSeeder::class);
        $this->call(ProductTableSeeder::class);
        $this->call(InventoryOrderTypeTableSeeder::class);
        $this->call(InventoryOrderTableSeeder::class);
        $this->call(InventoryOrderDetailTableSeeder::class);
        $this->call(RecipeTableSeeder::class);
        $this->call(RecipePlanificationTableSeeder::class);
        $this->call(OrderTableSeeder::class);
    }
}
