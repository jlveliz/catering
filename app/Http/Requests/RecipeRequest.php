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
            'title' =>'required|unique:recipes,title',
            'ingredients' => 'required',
            'steps' => 'required',
            'is_favorite' => 'required|boolean'
        ];
    }

    public function validateOnUpdate()
    {
        $recipeId = $this->route('recipe');
        $rules = $this->validateOnSave();
        $rules['inventory_order_id'] = 'exists:inventory_order,id';
        $rules['title'] = 'required|unique:recipes,title,'.$recipeId;
        return $rules;
    }
}
