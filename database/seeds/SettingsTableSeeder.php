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
        $businessPhone = $this->findSetting('business_phone');

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


        //Desayuno
        $breakfast = $this->findSetting('breakfast');

        if (!$breakfast) {
            Setting::create([
                'key' => 'breakfast',
                'value' => 'yes',
                'lock' => 1
            ]);
        }

        //Desayuno Dietetico
        $breakfast = $this->findSetting('dietary_breakfast');

        if (!$breakfast) {
            Setting::create([
                'key' => 'dietary_breakfast',
                'value' => 'no',
                'lock' => 1
            ]);
        }


        //Almuerzo
        $lunch = $this->findSetting('lunch');

        if (!$lunch) {
            Setting::create([
                'key' => 'lunch',
                'value' => 'yes',
                'lock' => 1
            ]);
        }

        //Almuerzo Dietetico
        $lunch = $this->findSetting('dietary_lunch');

        if (!$lunch) {
            Setting::create([
                'key' => 'dietary_lunch',
                'value' => 'no',
                'lock' => 1
            ]);
        }

         //Merienda
         $dinner = $this->findSetting('dinner');

         if (!$dinner) {
             Setting::create([
                 'key' => 'dinner',
                 'value' => 'yes',
                 'lock' => 1
             ]);
         }

         //Merienda de dieta
         $dinner = $this->findSetting('dietary_dinner');
         if (!$dinner) {
            Setting::create([
                'key' => 'dietary_dinner',
                'value' => 'no',
                'lock' => 1
            ]);
        }
    }

    private function findSetting($keyVal)
    {
        return Setting::where('key',$keyVal)->first();
    }
}