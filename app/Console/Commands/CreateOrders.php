<?php

namespace Catering\Console\Commands;

use Catering\Models\CustomerContract;
use Catering\Models\Order;
use Catering\Models\Setting;
use Illuminate\Console\Command;

class CreateOrders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create-orders:current';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'create customer orders based on the day before';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $startDate = $endDate = date('Y-m-d');
        $currentContracts = CustomerContract::where('start_date','<=',$startDate)->where('end_date','>=',$endDate)->get();

        $settingCount = Setting::where('key','default_count')->first();
        $defaultCount =  $settingCount ? $settingCount : 100;
        $defaultState = 'pendiente';


        //Extract all last Orders from a Detail
        if (count($currentContracts) > 0) {
            foreach ($currentContracts as $key => $contract) {
                //Si el contrato permite crear ordenes este dia
                if($contract->canCreateOrders()){
                    if ($contract->hasDetails()) {
                        foreach ($contract->details as $key => $detail) {
                            //Si tiene ordenes creara ordenes basadas en el dia antarior
                            //Si no tiene ordenes creara Ordenes Por default en base a los detalles

                            if ($detail->hasOrders()) {
                                $lastOrder = $detail->getLastOrder();
                                $defaultCount = $lastOrder->count;
                            }

                            $order = Order::create([
                                'customer_contract_detail_id' => $detail->id,
                                'date' => date('Y-m-d'),
                                'count' => $defaultCount,
                                'state' => $defaultState //TODO AUTOMATIZAR
                            ]);

                            $this->info("Order with date {$order->date} for {$order->contractDetail->setting_key_id} in  customer {$order->contractDetail->contract->customer->name}  Created succesfully!!");
                        }
                    } else {
                        $this->info('Contract '. $contract->id . ' no have details');
                    }
                }
            }
        } else {
            $this->info("No Orders for create");
        }



    }
}
