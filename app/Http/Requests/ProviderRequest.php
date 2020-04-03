<?php

namespace Catering\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProviderRequest extends FormRequest implements ValidationInterface
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
            'name' => 'required|unique:providers,name',
            'dni' => 'integer',
        ];
    }

    public function validateOnUpdate()
    {
        $providerId = $this->route('provider');
        $rules = $this->validateOnSave();
        $rules['name'] = 'required|unique:providers,name,'.$providerId;
        return $rules;
    }
}
