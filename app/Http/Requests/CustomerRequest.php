<?php

namespace Catering\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest implements ValidationInterface
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
            'identification_type' => 'required|exists:identification_types,id',
            'identification' => 'required|min:10|max:13|unique:customers,identification',
            'is_company' => 'required|boolean',
            'name' => 'required|string|max:55',
            'lastname' => 'string',
            'phone' => 'required|min:6',
            'mobile' => 'min:10',
            'email' => 'required|email|unique:customers,email',
            'address' => 'required|max:300',
            'legal_representant' => 'required_if:is_company,1|max:50|unique:customers,legal_representant',
            'payment_method_id' => 'required|exists:payment_methods,id',
            'cut_invoice' => 'required|in:inicio_mes,fin_mes,cada_quincena',
            'user_created_at' => 'required|exists:users,id'
        ];
    }

    public function validateOnUpdate()
    {
        $rules = $this->validateOnSave();
        $customerId = $this->route('customer');
        $rules['identification'] = 'required|min:10|max:13|unique:customers,identification,'.$customerId;
        $rules['email'] = 'required|email|unique:customers,email,'.$customerId;
        $rules['legal_representant'] =  'required_if:is_company,1|max:50|unique:customers,legal_representant,'.$customerId;
        return $rules;
    }
}
