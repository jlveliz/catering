<?php

namespace Catering\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{


    protected $fillable = [
        'dni',
        'name',
        'lastname',
        'date_birth',
        'genre',
        'address',
        'civil_status',
        'phone',
        'mobile',
        'email',
        'photo',
        'emergency_contact_name',
        'salary',
        'position',
        'date_admission',
        'date_departure',
        'state',
        'workplace_id',
        'user_created_at'
    ];

    /**
     * Cada Trabajador tiene un area de trabajo
     *
     * @return void
     */
    public function workplace()
    {
        return $this->belongsTo('Catering\Models\Workplace', 'workplace_id', 'id');
    }

    /**
     * Cada Trabajador o colaborador tiene un usuario creador
     *
     * @return void
     */
    public function creator()
    {
        return $this->belongsTo('Catering\Models\User', 'user_created_at', 'id');
    }
}
