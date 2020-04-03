<?php

namespace Catering\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class CustomerContract extends Model
{
    protected $fillable = [
        'contract_code',
        'customer_id',
        'frequency_key_id',
        'start_date',
        'end_date'
    ];

    /**
     * Relations
     *
     */


    public function customer()
    {
        return $this->belongsTo('Catering\Models\Customer','customer_id');
    }

    public function details()
    {
        return $this->hasMany('Catering\Models\CustomerContractDetail','customer_contract_id');
    }

    public function frequencyOfDays()
    {
        return $this->belongsTo('Catering\Models\Setting', 'frequency_key_id');
    }

    /**
     * Functions
     */
    public function hasDetails()
    {
        return count($this->details ) > 0 ? true :false;
    }

    /**
     * Permite saber si se puede crear o no una orden dependiendo
     * de lo que estipule el contrato y el dia actual
     * es decir si el contrato dice que se puede crear orden de lunes a viernes
     * y hoy es sabado o domingo no se puede crear una orden
     *
     * @return boolean
     */
    public function canCreateOrders()
    {
        if($this->frequencyOfDays)
        {
            $date = Carbon::now();
            $dayOfWeek = strtolower( $date->englishDayOfWeek);
            $frequencyName = $this->frequencyOfDays->key;
            if ($frequencyName == 'monday_to_sunday') {
                return true;
            } else if($frequencyName == 'monday_to_friday' && ($dayOfWeek == 'saturday' || $dayOfWeek == 'sunday'))  {
                return false;
            } else {
                return true;
            }

        } else {
            return false;
        }
    }
}
