<?php

namespace Catering\Http\Controllers;

use Illuminate\Http\Request;
use Catering\Models\User;
use Catering\Http\Resources\UserResource;
use Catering\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;
use DB;
use Exception;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Get all Users
        $users = User::all();

        //return all users on resources
        return UserResource::collection($users);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        DB::beginTransaction();

        try {
            $user = new User();
            $user->fill($request->all());
            $user->password = Hash::make($request->get('password'));
            $user->saveOrFail();
            DB::commit();
            return new UserResource($user);
        }catch(Exception $e) {
            DB::rollback();
            return response()->json(['message' => 'Hubo un error al ingresar el usuario, intente nuevamente'],411);
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
        $user = User::find($id);
        if ($user) {
            return new UserResource($user);
        }
        return response()->json(['message' => 'Usuario no encontrado'], 404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        DB::beginTransaction();

        try {
            $user = User::find($id);
            $user->fill($request->all());
            if ($request->has('password')) {
                $user->password = Hash::make($request->get('password'));
            }
            $user->saveOrFail();
            DB::commit();
            return new UserResource($user);
        }catch(Exception $e) {
            DB::rollback();
            return response()->json(['message' => 'Hubo un error al actualizar el usuario, intente nuevamente'],411);
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
        $user = User::find($id);
        if ($user) {
            $fullNameUser =  $user->name . ' ' . $user->lastname;
            if($user->delete())
                return response()->json(['message' => "Usuario {$fullNameUser} Eliminado  Correctamente"],200);
        }
        return response()->json(['message' => 'Usuario no encontrado'], 404);
    }
}
