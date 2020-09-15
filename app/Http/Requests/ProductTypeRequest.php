<?php

namespace Catering\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductTypeRequest extends FormRequest implements ValidationInterface
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
            'name' => 'required|string|unique:product_types,name',
            'slug' => 'required|string|unique:product_types,slug',
        ];
    }

    public function validateOnUpdate()
    {
        $prType = $this->route('pr_type');
        return [
            'name' => 'required|string|unique:product_types,name,'.$prType,
            'slug' => 'required|string|unique:product_types,slug,'.$prType,
        ];
    }
}
