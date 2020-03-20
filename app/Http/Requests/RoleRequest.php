<?php

namespace Catering\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
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
    /**
     * messages
     *
     * @return void
     */
    public function messages()
    {
        return [
            'locked.boolean' => 'El tipo de bloqueo del rol es invalido'
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
            'name' => 'required|string|unique:roles,name',
            'slug' => 'required|unique:roles,slug',
            'lock' => 'boolean'
        ];
    }

    /**
     * Validate a role when is updating
     *
     * @return void
     */
    private function validateOnUpdate()
    {
        $roleId =  $this->route('role');
        return [
            'name' => 'required|string|unique:roles,name,'.$roleId,
            'slug' => 'required|unique:roles,slug,'.$roleId,
        ];
    }



}
