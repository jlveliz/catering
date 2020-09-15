<?php

namespace Catering\Http\Controllers;

use Illuminate\Http\Request;
use Catering\Http\Requests\InvoiceDetailRequest;
use Catering\Http\Resources\InvoiceDetailResource;
use Catering\Models\Invoice;
use Catering\Models\InvoiceDetail;
use Exception;
use DB;

class InvoiceDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($invoice)
    {
        $details = InvoiceDetail::where('invoice_id',$invoice)->get();
        return InvoiceDetailResource::collection($details);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Catering\Http\Requests\InvoiceDetailRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store($invoice, InvoiceDetailRequest $request)
    {
        DB::beginTransaction();

        try {
            $invoice = Invoice::find($invoice);
            if ($invoice) {
                $detail = new InvoiceDetail();
                $detail->fill(request()->all());
                $detail->save();
                DB::commit();
                return new InvoiceDetailResource($detail);
            }
            return response()->json(['message' => 'El detalle no se puede guardar, factura no encontrada'], 404);
        }catch(Exception $e) {
            DB::rollback();
            return response()->json(
                [
                    'message' => 'Hubo un error al guardar el detalle, intente nuevamente',
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
    public function show($invoice, $id)
    {
        $detail = InvoiceDetail::where('invoice_id',$invoice)->where('id',$id)->first();
        if ($detail) {
            return new InvoiceDetailResource($detail);
        }
        return response()->json(['message' => 'Detalle de factura no encontrado'], 404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Catering\Http\Requests\InvoiceDetailRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(InvoiceDetailRequest $request, $invoice, $id)
    {
        DB::beginTransaction();

        try {
            $invoice = Invoice::find($invoice);

            if ($invoice) {

                $detail = $invoice->details()->find($id);

                if ($detail) {
                    $detail->fill(request()->all());
                    $detail->saveOrFail();
                    DB::commit();
                    return new InvoiceDetailResource($detail);
                }

                return response()->json(['message' => "Detalle {$id} de factura no encontrado"], 404);

            }
            return response()->json(['message' => 'Factura no encontrada'], 404);
        }catch(Exception $e) {
            DB::rollback();
            return response()->json(['message' => 'Hubo un error al actualizar la facura, intente nuevamente',
            'details' => $e->getMessage()],411);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($invoice, $id)
    {
        $invoice = Invoice::find($invoice);

        if ($invoice) {
            $invoiceCode =  $invoice->code;
            $detail = $invoice->details()->find($id);
            if ($detail) {
                $detailId = $detail->id;
                if($detail->delete())
                    return response()->json(['message' => "El detalle {$detailId} de la factura {$invoiceCode} eliminado  correctamente"],200);

            }
            return response()->json(['message' => "Detalle {$id} no encontrada"], 404);

        }
        return response()->json(['message' => 'Factura no encontrada'], 404);
    }
}
