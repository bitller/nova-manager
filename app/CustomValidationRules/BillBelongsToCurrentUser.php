<?php

namespace App\CustomValidationRules;

use Auth;

class BillBelongsToCurrentUser {

    /**
     * @param $attribute
     * @param $value
     * @param $parameters
     * @param $validator
     * @return bool
     */
    public function validate($attribute, $value, $parameters, $validator) {
        if (Auth::user()->bills()->where('bills.id', $value)->count()) {
            return true;
        }
        return false;
    }
}
