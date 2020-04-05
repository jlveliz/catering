<?php

namespace Catering\Http\Controllers;

use Illuminate\Http\Request;
use Catering\Http\Resources\ProductTypeResource;
use Catering\Http\Requests\ProductTypeRequest;
use Catering\Models\ProductType;
use Exception;
use DB;

class ProductTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $types = ProductType::all();
        return ProductTypeResource::collection($types);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Catering\Http\Requests\ProductTypeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductTypeRequest $request)
    {
        DB::beginTransaction();

        try {
            $prType = new ProductType();
            $prType->fill($request->all());
            $prType->saveOrFail();
            DB::commit();
            return new ProductTypeResource($prType);
        }catch(Exception $e) {
            DB::rollback();
            return response()->json(['message' => 'Hubo un error al ingresar el tipo de producto, intente nuevamente'],411);
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
        $prType = ProductType::find($id);
        if ($prType) {
            return new ProductTypeResource($prType);
        }
        return response()->json(['message' => 'Tipo de producto no encontrada'], 404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Catering\Http\Requests\ProductTypeRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductTypeRequest $request, $id)
    {
        DB::beginTransaction();

        try {
            $prType = ProductType::find($id);

            if ($prType) {
                $prType->fill($request->all());
                $prType->saveOrFail();
                DB::commit();
                return new ProductTypeResource($prType);
            }
            return response()->json(['message' => 'Tipo de producto no encontrada'], 404);
        }catch(Exception $e) {
            DB::rollback();
            return response()->json(['message' => 'Hubo un error al actualizar el tipo de producto, intente nuevamente'],411);
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
        $prType = ProductType::find($id);


        if ($prType) {
            // TODO VERIFICAR SI TIENE PRODUCTOS
            // if( count($prType->customers) > 0 ) return response()->json(['message' => "El tipo de identificacion {$prType->name} no puede ser eliminada por que un cliente usa este tipo de identificacion"], 411);

            $prTypeName =  $prType->name;
            if($prType->delete())
                return response()->json(['message' => "El tipo de producto {$prTypeName} Eliminado  Correctamente"],200);
        }
        return response()->json(['message' => 'Tipo de producto no encontrado'], 404);
    }
}
