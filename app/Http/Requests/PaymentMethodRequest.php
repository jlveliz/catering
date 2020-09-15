<?php

namespace Catering\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaymentMethodRequest extends FormRequest implements ValidationInterface
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
            'name' => 'required|unique:payment_methods,name',
            'lock' => 'required|boolean'
        ];
    }

    public function validateOnUpdate()
    {
        $method = $this->route('payment_method');
        $rules = $this->validateOnSave();
        $rules['name'] = 'required|unique:payment_methods,name,'.$method;
        return $rules;
    }
}
