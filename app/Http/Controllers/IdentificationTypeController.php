<?php

namespace Catering\Http\Controllers;

use Illuminate\Http\Request;
use Catering\Http\Requests\IdentificationTypeRequest;
use Catering\Models\IdentificationType;
use Catering\Http\Resources\IdentificationTypeResource;
use DB;
use Exception;

class IdentificationTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $idTypes = IdentificationType::all();
        return IdentificationTypeResource::collection($idTypes);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Catering\Http\Requests\IdentificationTypeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(IdentificationTypeRequest $request)
    {
        DB::beginTransaction();

        try {
            $idType = new IdentificationType();
            $idType->fill($request->all());
            if ($request->has('lock')) {
                $idType->lock = request('lock');
            }
            $idType->saveOrFail();
            DB::commit();
            return new IdentificationTypeResource($idType);
        }catch(Exception $e) {
            DB::rollback();
            return response()->json(['message' => 'Hubo un error al ingresar el tipo de identificacion, intente nuevamente'],411);
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
        $idType = IdentificationType::find($id);
        if ($idType) {
            return new IdentificationTypeResource($idType);
        }
        return response()->json(['message' => 'Tipo de identificacion no encontrada'], 404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Catering\Http\Requests\IdentificationTypeRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(IdentificationTypeRequest $request, $id)
    {
        DB::beginTransaction();

        try {
            $idType = IdentificationType::find($id);

            if ($idType) {
                $idType->fill($request->all());
                if ($request->has('lock')) {
                    $idType->lock = request('lock');
                }
                $idType->saveOrFail();
                DB::commit();
                return new IdentificationTypeResource($idType);
            }
            return response()->json(['message' => 'Tipo de identificacion no encontrada'], 404);
        }catch(Exception $e) {
            DB::rollback();
            return response()->json(['message' => 'Hubo un error al actualizar el tipo de identificacion, intente nuevamente'],411);
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
        $idType = IdentificationType::find($id);


        if ($idType) {

            $isLock = ($idType->lock == 1 ) ? true : false ;
            if ($isLock) return response()->json(['message' => "El tipo de identificacion {$idType->name} no puede ser eliminada"], 411);

            if( count($idType->customers) > 0 ) return response()->json(['message' => "El tipo de identificacion {$idType->name} no puede ser eliminada por que un cliente usa este tipo de identificacion"], 411);

            $idTypeName =  $idType->name;
            if($idType->delete())
                return response()->json(['message' => "El tipo de identificacion {$idTypeName} Eliminada  Correctamente"],200);
        }
        return response()->json(['message' => 'Tipo de identificacion no encontrada'], 404);
    }
}
