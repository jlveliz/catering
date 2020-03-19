<?php

use Illuminate\Database\Seeder;
use Catering\Models\User;
use Catering\Models\Role;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $password = Hash::make('password');
        $roleId = Role::where('slug','administrador')->first()->id;

        User::create([
            'name' => 'Jorge Luis',
            'email' => 'jorgeconsalvacion@gmail.com',
            'email_verified_at' => now(),
            'password' => $password,
            'username' => 'admin',
            'lastname' => 'Veliz Berzosa',
            'state' => 1,
            'role_id' => $roleId
        ]);
    }
}
