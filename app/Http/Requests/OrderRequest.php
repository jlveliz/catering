<?php

namespace Catering\Http\Requests;

use Catering\Rules\EqualValue;
use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest implements ValidationInterface
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
            'customer_contract_detail_id' => ['required','exists:customer_contract_details,id',new EqualValue($this->route('detail'))],
            'date' => 'required|date_format:Y-m-d|unique:orders,date',
            'count' => 'required|integer',
            'state' => 'required|in:pendiente,entregado,cancelado'
        ];
    }


    public function validateOnUpdate()
    {
        $orderId = $this->route('order');
        $rules = $this->validateOnSave();
        $rules['date'] = 'required|date_format:Y-m-d|unique:orders,date,'.$orderId;
        return $rules;
    }
}
