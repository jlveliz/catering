<?php

namespace Catering\Http\Controllers;

use Catering\Http\Resources\EmployeeResource;
use Catering\Models\Employee;
use Illuminate\Http\Request;
use Catering\Http\Requests\EmployeeRequest;
use Exception;
use DB;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employee::all();
        return EmployeeResource::collection($employees);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Catering\Http\Requests\EmployeeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmployeeRequest $request)
    {
        DB::beginTransaction();

        try {
            $employee = new Employee();
            $employee->fill($request->all());
            $employee->saveOrFail();
            DB::commit();
            return new EmployeeResource($employee);
        }catch(Exception $e) {
            DB::rollback();
            return response()->json(['message' => 'Hubo un error al ingresar el empleado, intente nuevamente', 'details'=>  $e->getMessage()],411);
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
        $employee = Employee::find($id);
        if ($employee) {
            return new EmployeeResource($employee);
        }
        return response()->json(['message' => 'Empleado no encontrado'], 404);
    }

    /**
     * Update the specified resource in storage.
     *
    * @param  \Catering\Http\Requests\EmployeeRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EmployeeRequest $request, $id)
    {
        DB::beginTransaction();

        try {
            $employee = Employee::find($id);
            $employee->fill($request->all());
            $employee->saveOrFail();
            DB::commit();
            return new EmployeeResource($employee);
        }catch(Exception $e) {
            DB::rollback();
            return response()->json(['message' => 'Hubo un error al actualizar el empleado, intente nuevamente'],411);
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
        $employee = Employee::find($id);

        if ($employee) {
            $isLock = ($employee->state == 1 ) ? true : false ;
            if ($isLock) return response()->json(['message' => "El empleado {$employee->name} {$employee->lastname} no puede ser eliminado"], 411);
            $employeeName =  $employee->name . ' ' . $employee->lastname;
            if($employee->delete())
                return response()->json(['message' => "Empleado {$employeeName} Eliminado  Correctamente"],200);
        }
        return response()->json(['message' => 'Empleado no encontrado'], 404);
    }
}
