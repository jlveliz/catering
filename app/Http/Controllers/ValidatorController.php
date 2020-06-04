<?php

namespace Catering\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ValidatorController extends Controller
{
    public function index(Request $request)
    {
        switch ($request->get('method')) {
            case 'unique':
                return $this->validateUnique($request);
                break;
            default:
                # code...
                break;
        }
    }


    private function validateUnique($request)
    {
        $id  = $request->has('id') ? $request->get('id') : null;

        $validator = Validator::make([
            $request->get('field') => $request->get('value')
        ], [
            $request->get('field') => [
                $id ? Rule::unique($request->get('table'))->ignore($id) :
                    Rule::unique($request->get('table'))
            ]
        ]);
        if ($validator->fails()) return response()->json(['data' => false], 200);
        return response()->json(['data' => true], 200);
    }
}
