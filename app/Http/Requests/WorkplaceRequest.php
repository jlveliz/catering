<?php

namespace Catering\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Catering\Http\Requests\ValidatorInterface;

class WorkplaceRequest extends FormRequest implements ValidationInterface
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
     * Validate a setting when is Saving
     *
     * @return void
     */
    public function validateOnSave()
    {
        return [
            'name' => 'required|string|unique:workplaces,name',
            'code' => 'required|string|unique:workplaces,code',
            'address' => 'string'
        ];
    }

    /**
     * Validate a role when is updating
     *
     * @return void
     */
    public function validateOnUpdate()
    {
        $wrkId =  $this->route('workplace');
        return [
            'name' => 'required|string|unique:workplaces,name,'.$wrkId,
            'code' => 'required|string|unique:workplaces,code,'.$wrkId,
            'address' => 'string'
        ];
    }
}
