<?php

use Illuminate\Database\Seeder;
use Catering\Models\Setting;
use Faker\Generator as Faker;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //Nombre del negocio
        $businessName = $this->findSetting('business_name');

        if (!$businessName) {
            Setting::create([
                'key' => 'business_name',
                'value' => config('app.name'),
                'lock' => 1
            ]);
        }

        //Direccion del negocio
        $businessAddress = $this->findSetting('business_address');

        if (!$businessAddress) {
            Setting::create([
                'key' => 'business_address',
                'value' => config('app.name') . ' Av.' ,
                'lock' => 1
            ]);
        }

        //Telf del negocio
        $businessPhone = $this->findSetting('phone_address');

        if (!$businessPhone) {
            Setting::create([
                'key' => 'business_phone',
                'value' => '22222',
                'lock' => 1
            ]);
        }



        //Tax
        $taxPercentage = $this->findSetting('iva');

        if (!$taxPercentage) {
            Setting::create([
                'key' => 'iva',
                'value' => '12',
                'lock' => 1
            ]);
        }

        //Currency Signal
        $taxPercentage = $this->findSetting('currency_signal');

        if (!$taxPercentage) {
            Setting::create([
                'key' => 'currency_signal',
                'value' => '$',
                'lock' => 1
            ]);
        }

        //Servicio de Lunes a Viernes
        $monToFriday = $this->findSetting('monday_to_friday');

        if (!$monToFriday) {
            Setting::create([
                'key' => 'monday_to_friday',
                'value' => 'yes',
                'lock' => 1
            ]);
        }

         //Servicio de Lunes a Domingo
         $monToSunday = $this->findSetting('monday_to_sunday');

         if (!$monToSunday) {
             Setting::create([
                 'key' => 'monday_to_sunday',
                 'value' => 'yes',
                 'lock' => 1
             ]);
         }
    }

    private function findSetting($keyVal)
    {
        return Setting::where('key',$keyVal)->first();
    }
}
