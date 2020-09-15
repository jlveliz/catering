<?php

namespace Catering\Rules;

use Carbon\Carbon;
use Illuminate\Contracts\Validation\Rule;

class MinDate implements Rule
{

    private $date;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($date)
    {
        $this->date = $date;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if ($this->date == 'now') {
            $dateObj = Carbon::create(date('Y'),date('m'),date('d'));
        } else {
            $dateObj = Carbon::create($this->date);
        }
        $valDateObj = Carbon::create($value);
        return $valDateObj->greaterThanOrEqualTo($dateObj);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return __('validation.custom.min-date');
    }
}
