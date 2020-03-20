<?php

namespace Catering\Http\Controllers;

use Illuminate\Http\Request;
use Catering\Models\Role;
use Catering\Http\Resources\RolesResource;
use Catering\Http\Requests\RoleRequest;
use Exception;
use DB;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();
        return RolesResource::collection($roles);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Catering\Http\Requests\RoleRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleRequest $request)
    {
        DB::beginTransaction();

        try {
            $role = new Role();
            $role->fill($request->all());
            if ($request->has('lock')) {
                $role->lock = request('lock');
            }
            $role->saveOrFail();
            DB::commit();
            return new RolesResource($role);
        }catch(Exception $e) {
            DB::rollback();
            return response()->json(['message' => 'Hubo un error al ingresar el rol, intente nuevamente'],411);
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
        $role = Role::find($id);
        if ($role) {
            return new RolesResource($role);
        }
        return response()->json(['message' => 'Rol no encontrado'], 404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Catering\Http\Requests\RoleRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RoleRequest $request, $id)
    {
        DB::beginTransaction();

        try {
            $role = Role::find($id);
            $role->fill($request->all());
            if ($request->has('lock')) {
                $role->lock = request('lock');
            }
            $role->saveOrFail();
            DB::commit();
            return new RolesResource($role);
        }catch(Exception $e) {
            DB::rollback();
            return response()->json(['message' => 'Hubo un error al actualizar el rol, intente nuevamente'],411);
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
        $role = Role::find($id);

        if ($role) {
            $isLock = ($role->lock == 1 ) ? true : false ;
            if ($isLock) return response()->json(['message' => "El rol {$role->name} no puede ser eliminado"], 411);

            $roleName =  $role->name;
            if($role->delete())
                return response()->json(['message' => "Rol {$roleName} Eliminado  Correctamente"],200);
        }
        return response()->json(['message' => 'Rol no encontrado'], 404);
    }
}
