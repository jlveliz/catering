<?php

namespace Catering\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        if($this->method() == 'POST') {
            return $this->validateOnSave();
        } else {
            return $this->validateOnUpdate();
        }
    }


    public function messages()
    {
        return [
            'state.boolean' => 'El estado es invalido'
        ];
    }



    /**
     * Validate a user when is Saving
     *
     * @return void
     */
    private function validateOnSave()
    {
        return [
            'username' => 'required|string|unique:users,username',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
            'name'=> 'required|string',
            'role_id' => 'required|exists:roles,id',
            'lastname' => 'required|string',
            'state' => 'required|boolean'
        ];
    }

    /**
     * Validate a user when is updating
     *
     * @return void
     */
    private function validateOnUpdate()
    {
        $userId =  $this->route('user');
        return [
            'username' => 'required|string|unique:users,username,'.$userId,
            'email' => 'required|email|unique:users,email,'.$userId,
            'name'=> 'required|string',
            'role_id' => 'required|exists:roles,id',
            'lastname' => 'required|string',
            'state' => 'required|boolean'
        ];
    }



}
