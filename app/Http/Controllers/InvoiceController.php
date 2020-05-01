<?php

namespace Catering\Http\Controllers;

use Catering\Events\InvoiceGenerated;
use Catering\Http\Requests\InvoiceRequest;
use Catering\Http\Resources\InvoiceResource;
use Catering\Models\Invoice;
use Catering\Models\Sequential;
use Illuminate\Http\Request;
use Exception;
use DB;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $invoices = Invoice::all();
        return InvoiceResource::collection($invoices);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Catering\Http\Requests\InvoiceRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(InvoiceRequest $request)
    {
        DB::beginTransaction();

        try {
            $invoice = new Invoice();
            $invoice->fill($request->all());
            //Create code
            $sequential = new Sequential();
            $invoice->code = $sequential->createCode('invoice');
            $invoice->saveOrFail();
            DB::commit();
            event(new InvoiceGenerated($invoice));
            return new InvoiceResource($invoice);
        }catch(Exception $e) {
            DB::rollback();
            return response()->json(['message' => 'Hubo un error al ingresar la factura, intente nuevamente', 'details'=>  $e->getMessage()],411);
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
        $invoice = Invoice::find($id);
        if ($invoice) {
            return new InvoiceResource($invoice);
        }
        return response()->json(['message' => 'Factura no encontrada'], 404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Catering\Http\Requests\InvoiceRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(InvoiceRequest $request, $id)
    {
        DB::beginTransaction();

        try {
            $invoice = Invoice::find($id);
            if ($invoice) {
                $invoice->fill($request->all());
                $invoice->saveOrFail();
                DB::commit();
                return new InvoiceResource($invoice);
            }
            return response()->json(['message' => 'Factura no encontrada'], 404);
        }catch(Exception $e) {
            DB::rollback();
            return response()->json(['message' => 'Hubo un error al actualizar la factura, intente nuevamente'],411);
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
        $invoice = Invoice::find($id);

        if ($invoice) {
            $title =  $invoice->detail;
            if($invoice->delete())
                return response()->json(['message' => "La factura con detalle {$title} Eliminada Correctamente"],200);
        }
        return response()->json(['message' => 'Factura no encontrada'], 404);
    }
}
