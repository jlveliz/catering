<?php

namespace Catering\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InvoiceRequest extends FormRequest implements ValidationInterface
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
            'customer_id' => 'required|exists:customers,id',
            'detail' => 'required',
            'state' => 'required|in:generada-manualmente,generada-automatica,pagada,mora',
            'pay_before_at' => 'required|date_format:Y-m-d',
            'pay_method_id' => 'required|exists:payment_methods,id',
            'subtotal' => 'required',
            'total_tax' => 'required',
            'discount_percentege' => 'string',
            'discount_total' => 'required_with:discount_percentage',
            'total_pay' => 'required',
            'user_created_at' => 'required|exists:users,id'
        ];
    }

    public function validateOnUpdate()
    {
        return $this->validateOnSave();
    }
}
