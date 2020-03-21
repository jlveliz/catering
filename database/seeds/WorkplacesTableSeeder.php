<?php

use Illuminate\Database\Seeder;

class WorkplacesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        return factory(\Catering\Models\Workplace::class,5)->create();
    }
}
