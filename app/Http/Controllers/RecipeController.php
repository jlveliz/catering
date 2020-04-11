<?php

namespace Catering\Http\Controllers;

use Catering\Http\Requests\RecipeRequest;
use Catering\Http\Resources\RecipeResource;
use Catering\Models\Recipe;
use Illuminate\Http\Request;
use DB;
use Exception;

class RecipeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $recipes = Recipe::all();
        return RecipeResource::collection($recipes);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Catering\Http\Requests\RecipeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RecipeRequest $request)
    {
        DB::beginTransaction();

        try {
            $recipe = new Recipe();
            $recipe->fill($request->all());
            $recipe->saveOrFail();
            DB::commit();
            return new RecipeResource($recipe);
        }catch(Exception $e) {
            DB::rollback();
            return response()->json(['message' => 'Hubo un error al ingresar la receta, intente nuevamente', 'details'=>  $e->getMessage()],411);
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
        $recipe = Recipe::find($id);
        if ($recipe) {
            return new RecipeResource($recipe);
        }
        return response()->json(['message' => 'Receta no encontrada'], 404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Catering\Http\Requests\RecipeRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RecipeRequest $request, $id)
    {
        DB::beginTransaction();

        try {
            $recipe = Recipe::find($id);
            if ($recipe) {
                $recipe->fill($request->all());
                $recipe->saveOrFail();
                DB::commit();
                return new RecipeResource($recipe);
            }
            return response()->json(['message' => 'Receta no encontrada'], 404);
        }catch(Exception $e) {
            DB::rollback();
            return response()->json(['message' => 'Hubo un error al actualizar la receta, intente nuevamente'],411);
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
        $recipe = Recipe::find($id);

        if ($recipe) {
            $recipeTitle =  $recipe->title;
            if($recipe->delete())
                return response()->json(['message' => "Receta {$recipeTitle} Eliminada  Correctamente"],200);
        }
        return response()->json(['message' => 'Receta no encontrada'], 404);
    }
}
