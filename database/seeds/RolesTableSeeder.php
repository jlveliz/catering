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
        $admin = $this->findRole('administrador');
        
        if(!$admin) {
            Role::create([
                'name' => 'Administrador',
                'slug' => 'administrador',
                'created_at' =>  now(),
                'updated_at' => now()
            ]);
        }

        $assistance = $this->findRole('asistente');

        if(!$assistance) {
            Role::create([
                'name' => 'Asistente',
                'slug' => 'Asistente',
                'created_at' =>  now(),
                'updated_at' => now()
            ]);
        }

        $inventory = $this->findRole('jefe_inventario');

        if(!$inventory) {
            Role::create([
                'name' => 'Jefe Inventario',
                'slug' => 'jefe-inventario',
                'created_at' =>  now(),
                'updated_at' => now()
            ]);
        }
        
    }

    private function findRole($slug)
    {
        return Role::where('slug',$slug)->first();
    }
}
