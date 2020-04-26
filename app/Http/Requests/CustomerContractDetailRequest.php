<?php

namespace Catering\Http\Requests;

use Catering\Rules\EqualValue;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CustomerContractDetailRequest extends FormRequest implements ValidationInterface
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
            'customer_contract_id' => ['required','exists:customer_contract_details,id',new EqualValue($this->route('contract'))],
            'setting_key_id' => 'required|exists:settings,key|in:breakfast,lunch,dinner,dietary_breakfast,dietary_lunch,dietary_dinner|unique:customer_contract_details,setting_key_id',
            'price' => 'required',
        ];
    }

    public function validateOnUpdate()
    {
        $detailId = $this->route('detail');
        $rules = $this->validateOnSave();
        $rules['setting_key_id'] = ['required','exists:settings,key','in:breakfast,lunch,dinner,dietary_breakfast,dietary_lunch,dietary_dinner', 'unique:customer_contract_details,id,'.$detailId ];
        return $rules;
    }
}
