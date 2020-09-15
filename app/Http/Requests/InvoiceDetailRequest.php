<?php

namespace Catering\Http\Requests;

use Catering\Rules\EqualValue;
use Illuminate\Foundation\Http\FormRequest;

class InvoiceDetailRequest extends FormRequest implements ValidationInterface
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
            'invoice_id' => ['required','exists:invoices,id', new EqualValue($this->route('invoice'))],
            'order_id' => 'required|exists:orders,id'
        ];
    }

    public function validateOnUpdate()
    {
        return $this->validateOnSave();
    }
}
