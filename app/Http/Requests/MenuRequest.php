<?php

namespace Catering\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MenuRequest extends FormRequest implements ValidationInterface
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
        if ($this->method() == 'POST') {
            return $this->validateOnSave();
        } else {
            return $this->validateOnUpdate();
        }
    }

    public function validateOnSave()
    {
       return [
            'name' => 'required|string|unique:menus,name',
            'route_name' => 'required|string',
            'parent_id' => 'required|exists:menus,id',
            'order' => 'required|integer',
            'enabled' => 'required|boolean'
       ];
    }

    public function validateOnUpdate()
    {
        $menuId = $this->route('menu');
        $rules = $this->validateOnSave();
        $rules['name'] = 'required|string|unique:menus,name,'.$menuId;
        return $rules;
    }
}
