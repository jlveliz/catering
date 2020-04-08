<?php

namespace Catering\Http\Controllers;

use Catering\Http\Requests\InventoryOrderDetailRequest;
use Catering\Http\Resources\InventoryOrderDetailResource;
use Catering\Models\InventoryOrder;
use Catering\Models\InventoryOrderDetail;
use Illuminate\Http\Request;
use Exception;
use DB;

class InventoryOrderDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($order)
    {
        $details = InventoryOrderDetail::where('inventory_order_id',$order)->get();
        return InventoryOrderDetailResource::collection($details);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Catering\Http\Requests\InventoryOrderDetailRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(InventoryOrderDetailRequest $request, $order)
    {
        DB::beginTransaction();

        try {
            $order = InventoryOrder::find($order);
            if ($order) {
                $detail = new InventoryOrderDetail();
                $detail->fill(request()->all());
                $detail->save();
                DB::commit();

                return new InventoryOrderDetailResource($detail);
            }
            return response()->json(['message' => 'El producto detalle para la orden {$order->code} no se puede guardar'], 404);
        }catch(Exception $e) {
            DB::rollback();
            return response()->json(
                [
                    'message' => 'Hubo un error al guardar el producto detalle, intente nuevamente',
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
    public function show($order,$id)
    {
        $detail = InventoryOrderDetail::where('inventory_order_id',$order)->where('id',$id)->first();
        if ($detail) {
            return new InventoryOrderDetailResource($detail);
        }
        return response()->json(['message' => 'Producto detalle no encontrado'], 404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Catering\Http\Requests\InventoryOrderDetailRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(InventoryOrderDetailRequest $request, $order, $id)
    {
        DB::beginTransaction();

        try {
            $order = InventoryOrder::find($order);
            if ($order) {
                $detail = $order->details()->find($id);
                if ($detail) {
                    $detail->fill(request()->all());
                    $detail->saveOrFail();
                    DB::commit();
                    return new InventoryOrderDetailResource($detail);
                }

                return response()->json(['message' => "Detalle producto {$id} no encontrado"], 404);

            }
            return response()->json(['message' => 'Orden no encontrado'], 404);
        }catch(Exception $e) {
            DB::rollback();
            return response()->json(['message' => 'Hubo un error al actualizar el producto detalle de la orden, intente nuevamente',
            'details' => $e->getMessage()],411);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($order, $id)
    {
        $order = InventoryOrder::find($order);

        if ($order) {

            $orderCode =  $order->code;

            $detail = $order->details()->find($id);


            if ($detail) {

                if($detail->delete())
                    return response()->json(['message' => "El producto detalle del contrato dela orden {$orderCode} ha sido eliminado  correctamente"],200);

            }

            return response()->json(['message' => "Producto detalle de orden {$orderCode} no encontrado"], 404);


        }
        return response()->json(['message' => 'Orden no encontrado'], 404);
    }
}
