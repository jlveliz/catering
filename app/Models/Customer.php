<?php

namespace Catering\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        'identification_type',
        'identification',
        'is_company',
        'name',
        'lastname',
        'phone',
        'mobile',
        'email',
        'address',
        'legal_representant',
        'payment_method_id',
        'cut_invoice',
        'user_created_at'
    ];
    /**
     * RELATIONS
     */
    public function creator()
    {
        return $this->belongsTo('Catering\Models\User', 'user_created_at');
    }

    public function idType()
    {
        return $this->belongsTo('Catering\Models\IdentificationType', 'identification_type');
    }

    public function contracts()
    {
        return $this->hasMany('Catering\Models\CustomerContract','customer_id');
    }

    /**
     * FUNCTIONS
     */
    public function getCurrentContract()
    {
        return $this->contracts()->where('start_date','<=',date('Y-m-d'))->where('end_date','>=',date('Y-m-d'))->first();
    }

    public function hasCurrentContract()
    {
        return $this->getCurrentContract() ?  true : false;
    }

    public function getAllCanBill()
    {
        $currentDate = date('Y-m-d');
        return $this->whereRaw( $this->id . " = (  select cc.customer_id from customer_contracts cc where cc.start_date <=  {$currentDate}  and cc.end_date >= {$currentDate} ) ");
    }
}
