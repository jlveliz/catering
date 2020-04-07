<?php

namespace Catering\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest implements ValidationInterface
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
            'product_type_id' => 'required|exists:product_types,id',
            'setting_key_id' => 'required|exists:settings,id',
            'name' => 'required|unique:products,name',
            'count' => 'required|integer',
        ];
    }

    public function validateOnUpdate()
    {
        $productId = $this->route('product');
        $rules = $this->validateOnSave();
        $rules['name'] = 'required|unique:products,name,'.$productId;
        return $rules;
    }
}
