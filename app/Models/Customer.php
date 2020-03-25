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
        'payment_method',
        'cut_invoice',
        'user_created_at'
    ];

    public function creator()
    {
        return $this->belongsTo('Catering\Models\User', 'user_created_at');
    }

    public function idType()
    {
        return $this->belongsTo('Catering\Models\IdentificationType', 'identification_type');
    }
}
