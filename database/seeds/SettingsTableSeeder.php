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
                'category' => 'general',
                'key' => 'business_name',
                'value' => config('app.name'),
                'lock' => 1
            ]);
        }

        //Direccion del negocio
        $businessAddress = $this->findSetting('business_address');

        if (!$businessAddress) {
            Setting::create([
                'category' => 'general',
                'key' => 'business_address',
                'value' => config('app.name') . ' Av.',
                'lock' => 1
            ]);
        }

        //Telf del negocio
        $businessPhone = $this->findSetting('business_phone');

        if (!$businessPhone) {
            Setting::create([
                'category' => 'general',
                'key' => 'business_phone',
                'value' => '22222',
                'lock' => 1
            ]);
        }

          //Telf del negocio
          $businessEmail = $this->findSetting('business_email');

          if (!$businessEmail) {
              Setting::create([
                  'category' => 'general',
                  'key' => 'business_email',
                  'value' => '22222',
                  'lock' => 1
              ]);
          }
  


        //Tax
        $taxPercentage = $this->findSetting('iva');

        if (!$taxPercentage) {
            Setting::create([
                'category' => 'invoice',
                'key' => 'iva',
                'value' => '12',
                'lock' => 1
            ]);
        }

        //Currency Signal
        $taxPercentage = $this->findSetting('currency_signal');

        if (!$taxPercentage) {
            Setting::create([
                'category' => 'currency',
                'key' => 'currency_signal',
                'value' => '$',
                'lock' => 1
            ]);
        }

        //Servicio de Lunes a Viernes
        $monToFriday = $this->findSetting('monday_to_friday');

        if (!$monToFriday) {
            Setting::create([
                'category' => 'service',
                'key' => 'monday_to_friday',
                'value' => 'yes',
                'lock' => 1
            ]);
        }

        //Servicio de Lunes a Domingo
        $monToSunday = $this->findSetting('monday_to_sunday');

        if (!$monToSunday) {
            Setting::create([
                'category' => 'service',
                'key' => 'monday_to_sunday',
                'value' => 'yes',
                'lock' => 1
            ]);
        }


        //Desayuno
        $breakfast = $this->findSetting('breakfast');

        if (!$breakfast) {
            Setting::create([
                'category' => 'service',
                'key' => 'breakfast',
                'value' => 'yes',
                'lock' => 1
            ]);
        }

        //Desayuno Dietetico
        $breakfast = $this->findSetting('dietary_breakfast');

        if (!$breakfast) {
            Setting::create([
                'category' => 'service',
                'key' => 'dietary_breakfast',
                'value' => 'no',
                'lock' => 1
            ]);
        }


        //Almuerzo
        $lunch = $this->findSetting('lunch');

        if (!$lunch) {
            Setting::create([
                'category' => 'service',
                'key' => 'lunch',
                'value' => 'yes',
                'lock' => 1
            ]);
        }

        //Almuerzo Dietetico
        $lunch = $this->findSetting('dietary_lunch');

        if (!$lunch) {
            Setting::create([
                'category' => 'service',
                'key' => 'dietary_lunch',
                'value' => 'no',
                'lock' => 1
            ]);
        }

        //Merienda
        $dinner = $this->findSetting('dinner');

        if (!$dinner) {
            Setting::create([
                'category' => 'service',
                'key' => 'dinner',
                'value' => 'yes',
                'lock' => 1
            ]);
        }

        //Merienda de dieta
        $dinner = $this->findSetting('dietary_dinner');
        if (!$dinner) {
            Setting::create([
                'category' => 'service',
                'key' => 'dietary_dinner',
                'value' => 'no',
                'lock' => 1
            ]);
        }

        //Libra
        $lb = $this->findSetting('lb');
        if (!$lb) {
            Setting::create([
                'category' => 'measure',
                'key' => 'weight',
                'value' => 'libra',
                'lock' => 1
            ]);
        }

        //Litro
        $l = $this->findSetting('l');
        if (!$l) {
            Setting::create([
                'category' => 'measure',
                'key' => 'l',
                'value' => 'Litro',
                'lock' => 1
            ]);
        }

        // Representante Legal
        $legal = $this->findSetting('legal_representant');
        if (!$legal) {
            Setting::create([
                'category' => 'invoice',
                'key' => 'legal_representant',
                'value' => 'Representante Legal',
                'lock' => 1
            ]);
        }

        // Invoice
        $taxIdentification = $this->findSetting('tax_identification');
        if (!$taxIdentification) {
            Setting::create([
                'category' => 'invoice',
                'key' => 'tax_identification',
                'value' => '9999999999',
                'lock' => 1
            ]);
        }

        //Invoice Sequential Initial
        $invoiceInitSequential = $this->findSetting('invoice_init_sequential');
        if (!$invoiceInitSequential) {
            Setting::create([
                'category' => 'invoice',
                'key' => 'invoice_init_sequential',
                'value' => 0,
                'lock' => 1
            ]);
        }

        //Invoice Date Generation Inicio de mes
        $invoiceDateGenerationBeginMonth = $this->findSetting('invoice_generation_begin_month');
        if (!$invoiceDateGenerationBeginMonth) {
            Setting::create([
                'category' => 'invoice',
                'key' => 'invoice_generation_begin_month',
                'value' => 29,
                'lock' => 1
            ]);
        }

        //Invoice Date Generation Fin de mes
        $invoiceDateGenerationEndMonth = $this->findSetting('invoice_generation_end_month');
        if (!$invoiceDateGenerationEndMonth) {
            Setting::create([
                'category' => 'invoice',
                'key' => 'invoice_generation_end_month',
                'value' => 25,
                'lock' => 1
            ]);
        }

        //Invoice Generation Cada quince
        $invoiceDateGenerationEach15Days = $this->findSetting('invoice_each_fifteen_days');
        if (!$invoiceDateGenerationEach15Days) {
            Setting::create([
                'category' => 'invoice',
                'key' => 'invoice_each_fifteen_days',
                'value' => 11,
                'lock' => 1
            ]);
        }

        //Dias de proroga por pago de una factura
        $waitForPayInvoices = $this->findSetting('wait_for_pay_invoices');
        if (!$waitForPayInvoices) {
            Setting::create([
                'category' => 'invoice',
                'key' => 'wait_for_pay_invoices',
                'value' => 11,
                'lock' => 1
            ]);
        }
    }

    private function findSetting($keyVal)
    {
        return Setting::where('key', $keyVal)->first();
    }
}
