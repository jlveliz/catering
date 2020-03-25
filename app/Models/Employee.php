<?php

namespace Catering\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{

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
        return $this->belongsTo('Catering\Models\User', 'user_created_id', 'id');
    }
}
