<?php

namespace Catering\Http\Controllers;

use Catering\Http\Requests\RecipePlanificationRequest;
use Catering\Models\RecipePlanification;
use Illuminate\Http\Request;
use Catering\Http\Resources\RecipePlanificationResource;
use DB;
use Exception;

class RecipePlanificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $planifications = RecipePlanification::orderBy('date_cook','asc')->get();
        return RecipePlanificationResource::collection($planifications);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Catering\Http\Requests\RecipePlanificationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RecipePlanificationRequest $request)
    {
        DB::beginTransaction();

        try {
            $planification = new RecipePlanification();
            $planification->fill($request->all());
            $planification->saveOrFail();
            DB::commit();
            return new RecipePlanificationResource($planification);
        }catch(Exception $e) {
            DB::rollback();
            return response()->json(['message' => 'Hubo un error al ingresar la planificacion, intente nuevamente', 'details'=>  $e->getMessage()],411);
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
        $planification = RecipePlanification::find($id);
        if ($planification) {
            return new RecipePlanificationResource($planification);
        }
        return response()->json(['message' => 'Planificacion no encontrada'], 404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Catering\Http\Requests\RecipePlanificationRequest   $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RecipePlanificationRequest $request, $id)
    {
        DB::beginTransaction();

        try {
            $planification = RecipePlanification::find($id);
            if ($planification) {
                $planification->fill($request->all());
                $planification->saveOrFail();
                DB::commit();
                return new RecipePlanificationResource($planification);
            }
            return response()->json(['message' => 'Planificacion no encontrada'], 404);
        }catch(Exception $e) {
            DB::rollback();
            return response()->json(['message' => 'Hubo un error al actualizar la planificacion, intente nuevamente'],411);
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
        $planification = RecipePlanification::find($id);

        if ($planification) {
            $recipeTitle =  $planification->recipe->title;
            $datePlan = $planification->date_cook;
            if($planification->delete())
                return response()->json(['message' => "Planificacion de {$recipeTitle} de la fecha {$datePlan} eliminada  Correctamente"],200);
        }
        return response()->json(['message' => 'Planificacion no encontrada'], 404);
    }
}
