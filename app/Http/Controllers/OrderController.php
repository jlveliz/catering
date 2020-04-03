<?php

namespace Catering\Http\Controllers;

use Catering\Http\Requests\OrderRequest;
use Catering\Http\Resources\OrderResource;
use Catering\Models\CustomerContractDetail;
use Catering\Models\Order;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($detail)
    {
        $orders = Order::where('customer_contract_detail_id', $detail)->orderBy('date','asc')->get();
        return OrderResource::collection($orders);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Catering\Http\Requests\OrderRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OrderRequest $request, $detailId)
    {
        DB::beginTransaction();

        try {
            $detail = CustomerContractDetail::find($detailId);
            if ($detail) {
                $order = new Order();
                $order->fill(request()->all());
                $order->save();
                DB::commit();
                return new OrderResource($order);
            }
            return response()->json(['message' => 'Detalle de contracto {$detail->contract->contract_code} no se puede guardar'], 404);
        } catch (Exception $e) {
            DB::rollback();
            return response()->json(
                [
                    'message' => 'Hubo un error al guardar la orden, intente nuevamente',
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
    public function show($detailId, $id)
    {
        $order = Order::where('customer_contract_detail_id', $detailId)->where('id', $id)->first();
        if ($order) {
            return new OrderResource($order);
        }
        return response()->json(['message' => 'Orden no encontrada'], 404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Catering\Http\Requests\OrderRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(OrderRequest $request, $detailId, $id)
    {
        DB::beginTransaction();

        try {
            $detail = CustomerContractDetail::find($detailId);

            if ($detail) {

                $order = $detail->orders()->find($id);

                if ($order) {
                    $order->fill(request()->all());
                    $order->saveOrFail();
                    DB::commit();
                    return new OrderResource($order);
                }

                return response()->json(['message' => "Orden {$id} no encontrado"], 404);
            }
            return response()->json(['message' => 'Detalle de contrato no encontrado'], 404);
        } catch (Exception $e) {
            DB::rollback();
            return response()->json([
                'message' => 'Hubo un error al actualizar la orden de contrato, intente nuevamente',
                'details' => $e->getMessage()
            ], 411);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($detailId, $id)
    {
        $detail = CustomerContractDetail::find($detailId);

        if ($detail) {
            $order = $detail->orders()->find($id);
            if ($order) {
                $orderId = $order->id;
                if ($order->delete())
                    return response()->json(['message' => "La orden {$orderId} fue eliminada correctamente"], 200);
            }

            return response()->json(['message' => "Orden {$id} no encontrada"], 404);
        }
        return response()->json(['message' => 'Detalle de contrato no encontrado'], 404);
    }

    public function getLastOrder($detailId)
    {
        $detail = CustomerContractDetail::find($detailId);
        if ($detail) {
            if ($detail->hasOrders()) {
                return  new OrderResource($detail->getLastOrder());
            }
        }

        return response()->json(['message' => 'Detalle de contrato no encontrado'], 404);
    }
}
