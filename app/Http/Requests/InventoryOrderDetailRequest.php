<?php

namespace Catering\Http\Requests;

use Catering\Rules\EqualValue;
use Illuminate\Foundation\Http\FormRequest;

class InventoryOrderDetailRequest extends FormRequest implements ValidationInterface
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
            'inventory_order_id' => ['required','exists:inventory_orders,id', new EqualValue($this->route('inventory_order'))],
            'product_id' => ['required','exists:products,id'],
            'count' => 'required|integer',
            'setting_key_id' => 'required|exists:settings,id',
        ];
    }

    public function validateOnUpdate()
    {
        return $this->validateOnSave();
    }
}
