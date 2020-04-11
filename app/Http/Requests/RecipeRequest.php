<?php

namespace Catering\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RecipeRequest extends FormRequest implements ValidationInterface
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
       if ($this->method() == 'POST')
       {
           return $this->validateOnSave();
       } else {
           return $this->validateOnUpdate();
       }
    }

    public function validateOnSave()
    {
        return [
            'setting_key_id' => 'required|exists:settings,id',
            'title' =>'required',
            'ingredients' => 'required',
            'steps' => 'required',
            'date_cook' => 'required|date_format:Y-m-d'
        ];
    }

    public function validateOnUpdate()
    {
        $rules = $this->validateOnSave();
        $rules['inventory_order_id'] = 'exists:inventory_order,id';
        return $rules;
    }
}
