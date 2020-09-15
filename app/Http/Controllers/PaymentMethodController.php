<?php

namespace Catering\Http\Controllers;

use Illuminate\Http\Request;
use Catering\Http\Requests\PaymentMethodRequest;
use Catering\Http\Resources\PaymentMethodResource;
use Catering\Models\PaymentMethod;
use DB;
Use Exception;

class PaymentMethodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $methods = PaymentMethod::all();
        return PaymentMethodResource::collection($methods);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Catering\Http\Requests\PaymentMethodRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PaymentMethodRequest $request)
    {
        DB::beginTransaction();

        try {
            $method = new PaymentMethod();
            $method->fill($request->all());
            if ($request->has('lock')) {
                $method->lock = request('lock');
            }
            $method->saveOrFail();
            DB::commit();
            return new PaymentMethodResource($method);
        }catch(Exception $e) {
            DB::rollback();
            return response()->json(['message' => 'Hubo un error al ingresar el metodo de pago, intente nuevamente'],411);
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
        $method = PaymentMethod::find($id);
        if ($method) {
            return new PaymentMethodResource($method);
        }
        return response()->json(['message' => 'Metodo de pago no encontrado'], 404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Catering\Http\Requests\PaymentMethodRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PaymentMethodRequest $request, $id)
    {
        DB::beginTransaction();

        try {
            $method = PaymentMethod::find($id);
            if ($method) {
                $method->fill($request->all());
                if ($request->has('lock')) {
                    $method->lock = request('lock');
                }
                $method->saveOrFail();
                DB::commit();
                return new PaymentMethodResource($method);
            }
            return response()->json(['message' => 'Metodo de pago no encontrado'], 404);
        }catch(Exception $e) {
            DB::rollback();
            return response()->json(['message' => 'Hubo un error al actualizar el metodo de pago, intente nuevamente'],411);
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

        $method = PaymentMethod::find($id);
        if ($method) {
            $isLock = ($method->lock == 1 ) ? true : false ;
            if ($isLock) return response()->json(['message' => "El metodo de pago {$method->name} no puede ser eliminada"], 411);
            $methodName =  $method->name;
            if($method->delete())
                return response()->json(['message' => "Metodo de pago {$methodName} Eliminado  Correctamente"],200);
        }
        return response()->json(['message' => 'Metodo de pago no encontrado'], 404);
    }
}
