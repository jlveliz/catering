<?php

use Catering\Models\IdentificationType;
use Illuminate\Database\Seeder;

class IdentificationTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(IdentificationType::class,2)->create();
    }
}
