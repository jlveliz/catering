<?php

namespace Catering\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use  Catering\Http\Requests\ValidationInterface;
use Catering\Rules\EqualValue;

class CustomerContractRequest extends FormRequest implements ValidationInterface
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
            'contract_code' => ['required','unique:customer_contracts','max:30'],
            'customer_id' => ['required','exists:customers,id',new EqualValue($this->route('customer'))],
            'frequency_key_id' => 'required|in:monday_to_friday,monday_to_sunday',
            'start_date' => 'required|date_format:Y-m-d',
            'end_date' => 'required|date_format:Y-m-d',
        ];

    }

    public function validateOnUpdate()
    {
        $contractId = $this->route('contract');
        $rules = $this->validateOnSave();
        $rules['contract_code'] = 'required|max:30|unique:customer_contracts,contract_code,'.$contractId;
        return $rules;
    }
}
