<?php

namespace App\CustomValidationRules;

use Illuminate\Support\Facades\DB;

/**
 * Custom validation rule.
 * Usage: not_exists:table,column
 *
 * @author Alexandru Bugarin <alexandru.bugarin@gmail.com>
 */
class NotExists {

    /**
     * @param $attribute
     * @param $value
     * @param $parameters
     * @param $validator
     * @return bool
     */
    public function validate($attribute, $value, $parameters, $validator) {
        if (DB::table($parameters[0])->where($parameters[1], $value)->count()) {
            return false;
        }

        return true;
    }

}