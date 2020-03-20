<?php

namespace Catering\Http\Controllers;

use Illuminate\Http\Request;
use Catering\Models\Setting;
use Catering\Http\Resources\SettingsResource;
use Catering\Http\Requests\SettingRequest;
use Exception;
use DB;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $settings = Setting::all();
        return SettingsResource::collection($settings);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Catering\Http\Requests\SettingRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SettingRequest $request)
    {

        DB::beginTransaction();

        try {
            $setting = new Setting();
            $setting->fill($request->all());
            if ($request->has('lock')) {
                $setting->lock = request('lock');
            }
            $setting->saveOrFail();
            DB::commit();
            return new SettingsResource($setting);
        }catch(Exception $e) {
            DB::rollback();
            return response()->json(['message' => 'Hubo un error al ingresar la configuración, intente nuevamente'],411);
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
        $setting = Setting::find($id);
        if ($setting) {
            return new SettingsResource($setting);
        }
        return response()->json(['message' => 'Configuración no encontrada'], 404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Catering\Http\Requests\SettingRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SettingRequest $request, $id)
    {
        DB::beginTransaction();

        try {
            $setting = Setting::find($id);
            $setting->fill($request->all());
            if ($request->has('lock')) {
                $setting->lock = request('lock');
            }
            $setting->saveOrFail();
            DB::commit();
            return new SettingsResource($setting);
        }catch(Exception $e) {
            DB::rollback();
            return response()->json(['message' => 'Hubo un error al actualizar la configuración, intente nuevamente'],411);
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
        $setting = Setting::find($id);


        if ($setting) {
            $isLock = ($setting->lock == 1 ) ? true : false ;
            if ($isLock) return response()->json(['message' => "La configuración {$setting->name} no puede ser eliminada"], 411);
            $settingName =  $setting->name;
            if($setting->delete())
                return response()->json(['message' => "Configuración {$settingName} Eliminada  Correctamente"],200);
        }
        return response()->json(['message' => 'Configuración no encontrada'], 404);
    }
}
