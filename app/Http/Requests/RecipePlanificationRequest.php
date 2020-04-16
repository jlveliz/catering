<?php

namespace Catering\Http\Requests;

use Catering\Rules\MinDate;
use Illuminate\Foundation\Http\FormRequest;

class RecipePlanificationRequest extends FormRequest implements ValidationInterface
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
            'recipe_id' => 'required|exists:recipes,id',
            'inventory_order_id' => 'exists:inventory_orders,id',
            'date_cook' => ['required','date_format:Y-m-d', new MinDate('now')]
        ];
    }


    public function validateOnUpdate()
    {
        return $this->validateOnSave();
    }
}
