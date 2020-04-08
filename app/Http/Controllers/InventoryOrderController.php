<?php

namespace Catering\Http\Controllers;

use Catering\Http\Requests\InventoryOrderRequest;
use Catering\Models\InventoryOrder;
use Catering\Http\Resources\InventoryOrderResource;
use Illuminate\Http\Request;
use DB;
use Exception;

class InventoryOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $inventories = InventoryOrder::all();
        return InventoryOrderResource::collection($inventories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Catering\Http\Requests\InventoryOrderRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(InventoryOrderRequest $request)
    {
        DB::beginTransaction();

        try {
            $invOrder = new InventoryOrder();
            $invOrder->fill($request->all());
            $invOrder->saveOrFail();
            DB::commit();
            return new InventoryOrderResource($invOrder);
        } catch (Exception $e) {
            DB::rollback();
            return response()->json(['message' => 'Hubo un error la orden de inventario, intente nuevamente', 'details' =>  $e->getMessage()], 411);
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
        $invOrder = InventoryOrder::find($id);
        if ($invOrder) {
            return new InventoryOrderResource($invOrder);
        }
        return response()->json(['message' => 'Orden no encontrada'], 404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Catering\Http\Requests\InventoryOrderRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(InventoryOrderRequest $request, $id)
    {
        DB::beginTransaction();

        try {
            $invOrder = InventoryOrder::find($id);
            $invOrder->fill($request->all());
            $invOrder->saveOrFail();
            DB::commit();
            return new InventoryOrderResource($invOrder);
        } catch (Exception $e) {
            DB::rollback();
            return response()->json(['message' => 'Hubo un error al actualizar la orden, intente nuevamente'], 411);
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
        $invOrder = InventoryOrder::find($id);

        if ($invOrder) {
            $invOrderName =  $invOrder->code;
            if ($invOrder->delete())
                return response()->json(['message' => "Orden de inventario {$invOrderName} Eliminado  Correctamente"], 200);
        }
        return response()->json(['message' => 'Orden no encontrada'], 404);
    }
}
