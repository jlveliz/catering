<?php

namespace Catering\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest implements ValidationInterface
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
        if($this->method() == 'POST') {
            return $this->validateOnSave();
        } else {
            return $this->validateOnUpdate();
        }
    }

     /**
     * Validate a setting when is Saving
     *
     * @return void
     */
    public function validateOnSave()
    {
        return [
            'key' => 'required|string|unique:settings,key',
            'value' => 'required',
            'lock' => 'boolean'
        ];
    }

    /**
     * Validate a role when is updating
     *
     * @return void
     */
    public function validateOnUpdate()
    {
        $settingId =  $this->route('setting');
        return [
            'key' => 'required|string|unique:settings,key,'.$settingId,
            'value' => 'required',
        ];
    }

}
