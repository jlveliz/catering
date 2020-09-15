<?php

namespace Catering\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'recipe_id',
        'customer_contract_detail_id',
        'date',
        'count',
        'state'
    ];

    /**
     * RELATIONS
     */
    public function contractDetail()
    {
        return $this->belongsTo('Catering\Models\CustomerContractDetail', 'customer_contract_detail_id');
    }


    /**
     * Functions
     */


    /**
     * Extrae las ordenes de un cliente en un contrato actual
     *
     * @param [int] $customerId
     * @param string $stateOrder
     * @param string $contract
     * @return void
     */
    public function getOrdersByCustomerCurrentContract($customerId, $stateOrder = 'entregado')
    {
        $cDate = date('Y-m-d');

        return $this->whereRaw(
            " orders.customer_contract_detail_id in (
                select
		            customer_contract_details.id
	            from
		            customer_contract_details
                where
                    customer_contract_details.customer_contract_id in (
                        select
			                customer_contracts.id
		                from
			                customer_contracts
                        where
                            (
                                customer_contracts.start_date <= '{$cDate}'
                                and
                                customer_contracts.end_date >= '{$cDate}'
                            )
                            and customer_contracts.customer_id in (
                                select
                                    customers.id
                                from
                                    customers
                                where
                                    customers.id = {$customerId}
                            )


                    )
            ) and orders.state = '{$stateOrder}'"
        )->get();

    }
}
