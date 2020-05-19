<?php

use Catering\Models\Menu;
use Illuminate\Database\Seeder;

class MenuTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createDashboard();
        $this->createCustomer();
        $this->createRecipes();
        $this->createInventory();
        $this->createAccounting();
        $this->createHumanTalent();
        $this->createSetting();
    }

    public function createDashboard()
    {
        //Dashboard
        $dashboard = [
            'name' => 'Escritorio',
            'route_name' => 'home',
            'icon' => 'sidebar',
            'order' => '1',
            'enabled' => true
        ];

        Menu::updateOrCreate($dashboard);
    }

    public function createCustomer()
    {

        // Clientes
        $customerMenu = [
            'name' => 'Customers',
            'route_name' => '',
            'icon' => 'briefcase',
            'order' => 2,
            'enabled' => true
        ];

        $customerMenu = Menu::updateOrCreate($customerMenu);

        $listCustomer = [
            'name' => 'Listado',
            'route_name' => 'customers',
            'parent_id' => $customerMenu->id,
            'icon' => 'list',
            'order' => 1,
            'enabled' => true
        ];

        $contracts = [
            'name' => 'Contratos',
            'route_name' => 'contracts',
            'parent_id' => $customerMenu->id,
            'icon' => 'doc',
            'order' => 2,
            'enabled' => true
        ];

        $orders = [
            'name' => 'Ordenes',
            'route_name' => 'orders',
            'parent_id' => $customerMenu->id,
            'icon' => 'service',
            'order' => 3,
            'enabled' => true
        ];

        Menu::updateOrCreate($listCustomer);
        Menu::updateOrCreate($contracts);
        Menu::updateOrCreate($orders);
    }
    /**
     * Recetas
     */
    public function createRecipes()
    {
        // Clientes
        $recipes = [
            'name' => 'Recetas',
            'route_name' => '',
            'icon' => 'list',
            'order' => 3,
            'enabled' => true
        ];

        $recipe = Menu::updateOrCreate($recipes);

        //List Recipes
        $listRecipes = [
            'name' => 'Lista',
            'route_name' => 'recipes',
            'parent_id' => $recipe->id,
            'icon' => 'list',
            'order' => 1,
            'enabled' => true
        ];

        Menu::updateOrCreate($listRecipes);

        //Manage Recipes
        $planification = [
            'name' => 'Planificacion',
            'route_name' => 'planning',
            'parent_id' => $recipe->id,
            'icon' => 'plan',
            'order' => 2,
            'enabled' => true
        ];

        Menu::updateOrCreate($planification);
    }

    public function createInventory()
    {
        // Inventory
        $inventory = [
            'name' => 'Inventario',
            'route_name' => '',
            'icon' => 'box',
            'order' => 4,
            'enabled' => true
        ];

        $inventory = Menu::updateOrCreate($inventory);


        $products = [
            'name' => 'Productos',
            'route_name' => 'products',
            'parent_id' => $inventory->id,
            'icon' => 'product',
            'order' => 1,
            'enabled' => true
        ];

        $registers = [
            'name' => 'Registros',
            'route_name' => 'registers',
            'parent_id' => $inventory->id,
            'icon' => 'order',
            'order' => 2,
            'enabled' => true
        ];

        $providers = [
            'name' => 'Proveedores',
            'route_name' => 'providers',
            'parent_id' => $inventory->id,
            'icon' => 'provider',
            'order' => 3,
            'enabled' => true
        ];

        Menu::updateOrCreate($products);
        Menu::updateOrCreate($registers);
        Menu::updateOrCreate($providers);
    }

    public function createAccounting()
    {
        // Accounting
        $accounting = [
            'name' => 'Contabilidad',
            'route_name' => '',
            'icon' => 'dollar-sign',
            'order' => 5,
            'enabled' => true
        ];

        $accounting = Menu::updateOrCreate($accounting);

        $invoices = [
            'name' => 'Facturas',
            'route_name' => 'invoices',
            'parent_id' => $accounting->id,
            'icon' => 'accounting',
            'order' => 1,
            'enabled' => true
        ];

        Menu::updateOrCreate($invoices);
    }

    public function createHumanTalent()
    {
        // Human Talent
        $humanTalent = [
            'name' => 'R.R.H.H.',
            'route_name' => '',
            'icon' => 'users',
            'order' => 6,
            'enabled' => true
        ];

        $humanTalent = Menu::updateOrCreate($humanTalent);

        // Human Talent
        $employees = [
            'name' => 'Employees',
            'route_name' => 'employees',
            'icon' => 'persons',
            'order' => 1,
            'parent_id' => $humanTalent->id,
            'enabled' => true
        ];

        Menu::updateOrCreate($employees);
    }

    public function createSetting()
    {
        // Setting
        $settings = [
            'name' => 'Configuracion',
            'route_name' => '',
            'icon' => 'settings',
            'order' => 7,
            'enabled' => true
        ];

        $settings = Menu::updateOrCreate($settings);

        // Users
        $users = [
            'name' => 'Usuarios',
            'route_name' => 'users',
            'icon' => 'users',
            'order' => 1,
            'parent_id' => $settings->id,
            'enabled' => true
        ];

        Menu::updateOrCreate($users);

        // Accounting
        $accounting = [
            'name' => 'Contabilidad',
            'route_name' => 'accounting',
            'icon' => 'accounting',
            'order' => 2,
            'parent_id' => $settings->id,
            'enabled' => true
        ];

        Menu::updateOrCreate($accounting);

        // WorkPlace
        $workplace = [
            'name' => 'Lugares de trabajo',
            'route_name' => 'workplace',
            'icon' => 'workplace',
            'order' => 3,
            'parent_id' => $settings->id,
            'enabled' => true
        ];

        Menu::updateOrCreate($workplace);

        // Settings
        $setting = [
            'name' => 'Configuracion',
            'route_name' => 'settings',
            'icon' => 'cog',
            'order' => 4,
            'parent_id' => $settings->id,
            'enabled' => true
        ];

        Menu::updateOrCreate($setting);
    }
}
