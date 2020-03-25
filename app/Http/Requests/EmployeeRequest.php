<?php

namespace Catering\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeRequest extends FormRequest implements ValidationInterface
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

    public function validateOnSave()
    {
        return [
            'dni' => 'required|unique:employees,dni|size:10',
            'name'=> 'required|string|max:55',
            'lastname'=> 'required|string|max:55',
            'date_birth' => 'required|date_format:Y-m-d',
            'genre' => 'required|in:masculino,femenino',
            'address' => 'required|max:300',
            'civil_status' => 'in:casado,soltero,viudo,divorciado,union-libre',
            'phone' => 'required|min:6',
            'mobile' => 'min:10',
            'email' => 'required|email|unique:employees,email',
            'photo' => 'file|mimes:jpg,jpeg,gif,png|size:2048',
            'emergency_contact_name' => 'string',
            'salary' => 'numeric',
            'position' => 'required|max:45',
            'date_admission' =>'date_format:Y-m-d',
            'date_departure' => 'date_format:Y-m-d',
            'state' => 'required|boolean',
            'workplace_id' => 'required|exists:workplaces,id',
            'user_created_at' => 'required|exists:users,id'
        ];
    }

    public function validateOnUpdate()
    {
        $rules = $this->validateOnSave();
        $employeeId = $this->route('employee');

        $rules['dni'] = 'required|size:10|unique:employees,dni,'.$employeeId;
        $rules['email'] = 'required|email|unique:employees,email,'.$employeeId;
        return $rules;

    }
}
