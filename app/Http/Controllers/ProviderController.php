<?php

namespace Catering\Http\Controllers;

use Illuminate\Http\Request;
use Catering\Http\Requests\ProviderRequest;
use Catering\Http\Resources\ProviderResource;
use Catering\Models\Provider;
use Exception;
use DB;

class ProviderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $providers = Provider::all();
        return ProviderResource::collection($providers);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Catering\Http\Requests\ProviderRequest;  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProviderRequest $request)
    {
        DB::beginTransaction();

        try {
            $provider = new Provider();
            $provider->fill($request->all());
            $provider->saveOrFail();
            DB::commit();
            return new ProviderResource($provider);
        }catch(Exception $e) {
            DB::rollback();
            return response()->json(['message' => 'Hubo un error al ingresar el proveedor, intente nuevamente', 'details'=>  $e->getMessage()],411);
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
        $provider = Provider::find($id);
        if ($provider) {
            return new ProviderResource($provider);
        }
        return response()->json(['message' => 'Proveedor no encontrado'], 404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Catering\Http\Requests\ProviderRequest;  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProviderRequest $request, $id)
    {
        DB::beginTransaction();

        try {
            $provider = Provider::find($id);
            $provider->fill($request->all());
            $provider->saveOrFail();
            DB::commit();
            return new ProviderResource($provider);
        }catch(Exception $e) {
            DB::rollback();
            return response()->json(['message' => 'Hubo un error al actualizar el proveedor, intente nuevamente'],411);
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
        $provider = Provider::find($id);

        if ($provider) {
            $providerName =  $provider->name;
            if($provider->delete())
                return response()->json(['message' => "Proveedor {$providerName} Eliminado  Correctamente"],200);
        }
        return response()->json(['message' => 'Proveedor no encontrado'], 404);
    }
}
