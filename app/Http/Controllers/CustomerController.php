<?php

namespace Catering\Http\Controllers;

use Catering\Models\Customer;
use Catering\Http\Resources\CustomerResource;
use Catering\Http\Requests\CustomerRequest;
use Illuminate\Http\Request;
use Exception;
use DB;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customer::all();
        return CustomerResource::collection($customers);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Catering\Http\Requests\CustomerRequest   $request
     * @return \Illuminate\Http\Response
     */
    public function store(CustomerRequest $request)
    {
        DB::beginTransaction();

        try {
            $customer = new Customer();
            $customer->fill($request->all());
            if (request('is_company') == '0' || request('is_company')  == 0) {
                $customer->legal_representant = '';
            }
            $customer->saveOrFail();
            DB::commit();
            return new CustomerResource($customer);
        }catch(Exception $e) {
            DB::rollback();
            return response()->json(['message' => 'Hubo un error al ingresar el cliente, intente nuevamente', 'details'=>  $e->getMessage()],411);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $customer = Customer::find($id);
        if ($customer) {
            return new CustomerResource($customer);
        }
        return response()->json(['message' => 'Cliente no encontrado'], 404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Catering\Http\Requests\CustomerRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CustomerRequest $request, $id)
    {
        DB::beginTransaction();

        try {
            $customer = Customer::find($id);
            if ($customer) {
                $customer->fill($request->all());
                if (request('is_company') == '0' || request('is_company')  == 0) {
                    $customer->legal_representant = '';
                }
                $customer->saveOrFail();
                DB::commit();
                return new CustomerResource($customer);
            }
            return response()->json(['message' => 'Cliente no encontrado'], 404); 
        }catch(Exception $e) {
            DB::rollback();
            return response()->json(['message' => 'Hubo un error al actualizar el cliente, intente nuevamente'],411);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $customer = Customer::find($id);

        if ($customer) {
            $customerName =  $customer->name . ' ' . $customer->lastname ? $customer->lastname : '';
            if($customer->delete())
                return response()->json(['message' => "Cliente {$customerName} Eliminado  Correctamente"],200);
        }
        return response()->json(['message' => 'Cliente no encontrado'], 404);
    }
}
