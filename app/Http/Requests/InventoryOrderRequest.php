<?php

namespace Catering\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InventoryOrderRequest extends FormRequest implements ValidationInterface
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
            'order_type_id' => 'required|exists:inventory_order_types,id',
            'created_user_id' => 'required|exists:users,id',
            'code' => 'unique:inventory_orders,code'
        ];
    }

    public function validateOnUpdate()
    {
        $orderId = $this->route('inventory_order');
        $rules = $this->validateOnSave();
        $rules['code'] = 'required|unique:inventory_orders,code,'.$orderId;
        return $rules;
    }
}
