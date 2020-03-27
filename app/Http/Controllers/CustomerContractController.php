<?php

namespace Catering\Http\Controllers;

use Illuminate\Http\Request;
use Catering\Http\Requests\CustomerContractRequest;
use Catering\Http\Resources\CustomerContractResource;
use Catering\Models\Customer;
use Catering\Models\CustomerContract;
use Catering\Models\Setting;
use DB;
use Exception;

class CustomerContractController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($customer)
    {
        $contracts = CustomerContract::where('customer_id',$customer)->get();
        return CustomerContractResource::collection($contracts);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Catering\Http\Requests\CustomerContractRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CustomerContractRequest $request, $customer)
    {
        DB::beginTransaction();

        try {
            $customer = Customer::find($customer);
            if ($customer) {
                
                $settingKey = Setting::where('key',request('frequency_key_id'))->first()->id;

                $contract = new CustomerContract();
                $contract->fill(request()->all());
                $contract->frequency_key_id = $settingKey;
                $contract->save();
                DB::commit();
                
                return new CustomerContractResource($contract);
            }
            return response()->json(['message' => 'El contrato no se puede guardar contrato que el cliente no encontrado'], 404); 
        }catch(Exception $e) {
            DB::rollback();
            return response()->json(
                [
                    'message' => 'Hubo un error al guardar el contrato, intente nuevamente', 
                    'details' => $e->getMessage()
                ],
                411
            );
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($customer,$id)
    {
        $contract = CustomerContract::where('customer_id',$customer)->where('id',$id)->first(); 
        if ($contract) {
            return new CustomerContractResource($contract);
        }
        return response()->json(['message' => 'Contrato no encontrado'], 404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Catering\Http\Requests\CustomerContractRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CustomerContractRequest $request, $customer, $id)
    {
        DB::beginTransaction();

        try {
            $customer = Customer::find($customer);

            if ($customer) {
                
                $settingKey = Setting::where('key',request('frequency_key_id'))->first()->id;

                $contract = $customer->contracts()->find($id);

                if ($contract) {
                    $contract->fill(request()->all());
                    $contract->frequency_key_id = $settingKey;
                    $contract->saveOrFail();
                    DB::commit();
                    return new CustomerContractResource($contract);
                }
                
                return response()->json(['message' => "Contracto {$id} no encontrado"], 404); 

            }
            return response()->json(['message' => 'Cliente no encontrado'], 404); 
        }catch(Exception $e) {
            DB::rollback();
            return response()->json(['message' => 'Hubo un error al actualizar el contrato, intente nuevamente', 
            'details' => $e->getMessage()],411);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($customer, $id)
    {
        $customer = Customer::find($customer);

        if ($customer) {

            //TODO HACER VALIDACION PARA SABER SI ESE CONTRATO ESTA VIGENTE

            $customerName =  $customer->name . ' ' . $customer->lastname ? $customer->lastname : '';

            $contract = $customer->contracts()->find($id);

            if ($contract) {
                $contractCode = $contract->contract_code;
                if($contract->delete())
                    return response()->json(['message' => "El contrato {$contractCode} del cliente {$customerName} eliminado  correctamente"],200);
                
            }

            return response()->json(['message' => "Contracto {$id} no encontrado"], 404); 
            
        }
        return response()->json(['message' => 'Cliente no encontrado'], 404);
    }
}
