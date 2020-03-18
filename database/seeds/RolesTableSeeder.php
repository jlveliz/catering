<?php

use Illuminate\Database\Seeder;
use Catering\Models\Role;


class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'name' => 'Administrador',
            'slug' => 'administrador',
            'created_at' =>  now(),
            'updated_at' => now()
        ]);
    }
}
