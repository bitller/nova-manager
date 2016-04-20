<?php

namespace App\CustomValidationRules;

use Auth;
use Hash;

class CurrentUserpassword {

    /**
     * @param $attribute
     * @param $value
     * @param $parameters
     * @param $validator
     * @return bool
     */
    public function validate($attribute, $value, $parameters, $validator) {
        return Hash::check($value, Auth::user()->password);
    }
}
