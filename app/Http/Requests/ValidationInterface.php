<?php

namespace Catering\Http\Requests;


/**
 * Use Methods for validations
 */
interface ValidationInterface {

    public function validateOnSave();

    public function validateOnUpdate();

}
