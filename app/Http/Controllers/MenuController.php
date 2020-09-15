<?php

namespace Catering\Http\Controllers;

use Catering\Http\Requests\MenuRequest;
use Illuminate\Http\Request;
use Catering\Http\Resources\MenuResource;
use Catering\Models\Menu;
use Exception;
use DB;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menus = Menu::whereNull('parent_id')->where('enabled',1)->orderBy('order')->get();
        return MenuResource::collection($menus);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MenuRequest $request)
    {
        DB::beginTransaction();

        try {
            $menu = new Menu();
            $menu->fill($request->all());
            $menu->saveOrFail();
            DB::commit();
            return new MenuResource($menu);
        }catch(Exception $e) {
            DB::rollback();
            return response()->json(['message' => 'Hubo un error al ingresar el menu, intente nuevamente', 'details'=>  $e->getMessage()],411);
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
        $menu = Menu::find($id);
        if ($menu) {
            return new MenuResource($menu);
        }
        return response()->json(['message' => 'Menu no encontrado'], 404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MenuRequest $request, $id)
    {
        DB::beginTransaction();

        try {
            $menu = Menu::find($id);
            if ($menu) {
                $menu->fill($request->all());
                $menu->saveOrFail();
                DB::commit();
                return new MenuResource($menu);
            }
            return response()->json(['message' => 'Menu no encontrado'], 404);
        }catch(Exception $e) {
            DB::rollback();
            return response()->json(['message' => 'Hubo un error al actualizar el menu, intente nuevamente'],411);
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
        $menu = Menu::find($id);

        if ($menu) {
            $name =  $menu->name;
            if($menu->delete())
                return response()->json(['message' => "El menu {$name} Eliminada Correctamente"],200);
        }
        return response()->json(['message' => 'Menu no encontrado'], 404);
    }


    public function getRoutes()
    {
        $routes = Menu::select('route_name')->where('route_name','!=','')->get();
        return response()->json(['data' => $routes],200);
    }
}
