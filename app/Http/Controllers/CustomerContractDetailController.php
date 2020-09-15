<?php

namespace Catering\Http\Controllers;

use Illuminate\Http\Request;
use Catering\Http\Requests\CustomerContractDetailRequest;
use Catering\Http\Resources\CustomerContractDetailResource;
use Catering\Models\CustomerContract;
use Catering\Models\CustomerContractDetail;
use Exception;
use DB;

class CustomerContractDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($contract)
    {
        $details = CustomerContractDetail::where('customer_contract_id',$contract)->get();
        return CustomerContractDetailResource::collection($details);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Catering\Http\Requests\CustomerContractDetailRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CustomerContractDetailRequest $request, $contract)
    {
        DB::beginTransaction();

        try {
            $contract = CustomerContract::find($contract);
            if ($contract) {

                $detail = new CustomerContractDetail();
                $detail->fill(request()->all());
                $detail->save();
                DB::commit();

                return new CustomerContractDetailResource($detail);
            }
            return response()->json(['message' => 'El detalle para el contrato {$contract} no se puede guardar'], 404);
        }catch(Exception $e) {
            DB::rollback();
            return response()->json(
                [
                    'message' => 'Hubo un error al guardar el detalle del contrato, intente nuevamente',
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
    public function show($contract,$id)
    {
        $detail = CustomerContractDetail::where('customer_contract_id',$contract)->where('id',$id)->first();
        if ($detail) {
            return new CustomerContractDetailResource($detail);
        }
        return response()->json(['message' => 'Detalle de contrato no encontrado'], 404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Catering\Http\Requests\CustomerContractDetailRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CustomerContractDetailRequest $request, $contract ,$id)
    {
        DB::beginTransaction();

        try {
            $contract = CustomerContract::find($contract);

            if ($contract) {

                $detail = $contract->details()->find($id);

                if ($detail) {
                    $detail->fill(request()->all());
                    $detail->saveOrFail();
                    DB::commit();
                    return new CustomerContractDetailResource($detail);
                }

                return response()->json(['message' => "Detalle {$id} no encontrado"], 404);

            }
            return response()->json(['message' => 'Contrato no encontrado'], 404);
        }catch(Exception $e) {
            DB::rollback();
            return response()->json(['message' => 'Hubo un error al actualizar el detalle del contrato, intente nuevamente',
            'details' => $e->getMessage()],411);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($contract,$id)
    {
        $contract = CustomerContract::find($contract);

        if ($contract) {

            $contractCode =  $contract->contract_code;

            $detail = $contract->details()->find($id);


            if ($detail) {

                if($detail->delete())
                    return response()->json(['message' => "El detalle del contrato con codigo {$contractCode} ha sido eliminado  correctamente"],200);

            }

            return response()->json(['message' => "Detalle de contrato con codigo {$contractCode} no encontrado"], 404);


        }
        return response()->json(['message' => 'Contrato no encontrado'], 404);
    }
}
