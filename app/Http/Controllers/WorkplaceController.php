<?php

namespace Catering\Http\Controllers;

use Illuminate\Http\Request;
use Catering\Models\Workplace;
use Catering\Http\Resources\WorkplaceResource;
use Catering\Http\Requests\WorkplaceRequest;
use Exception;
use DB;

class WorkplaceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $workplaces = Workplace::all();
        return WorkplaceResource::collection($workplaces);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Catering\Http\Requests\WorkplaceRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(WorkplaceRequest $request)
    {
        DB::beginTransaction();

        try {
            $workplace = new Workplace();
            $workplace->fill($request->all());
            $workplace->saveOrFail();
            DB::commit();
            return new WorkplaceResource($workplace);
        }catch(Exception $e) {
            DB::rollback();
            return response()->json(['message' => 'Hubo un error al ingresar el lugar de trabajo, intente nuevamente'],411);
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
        $workplace = Workplace::find($id);
        if ($workplace) {
            return new WorkplaceResource($workplace);
        }
        return response()->json(['message' => 'Lugar de trabajo no encontrado'], 404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Catering\Http\Requests\WorkplaceRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(WorkplaceRequest $request, $id)
    {
        DB::beginTransaction();

        try {
            $workplace = Workplace::find($id);
            $workplace->fill($request->all());
            $workplace->saveOrFail();
            DB::commit();
            return new WorkplaceResource($workplace);
        }catch(Exception $e) {
            DB::rollback();
            return response()->json(['message' => 'Hubo un error al actualizar el lugar de trabajo, intente nuevamente'],411);
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
        $workplace = Workplace::find($id);

        if ($workplace) {
            $workplaceName =  $workplace->name;
            if($workplace->delete())
                return response()->json(['message' => "Lugar de trabajo {$workplaceName} Eliminado  Correctamente"],200);
        }
        return response()->json(['message' => 'Lugar de Trabajo no encontrado'], 404);
    }
}
