<?php

namespace App\CustomValidationRules;

use Auth;

/**
 * Usage: not_belongs_to_another_client_of_same_user:column_name
 *
 * @author Alexandru Bugarin <alexandru.bugarin@gmail.com>
 */
class NotBelongsToAnotherClientOfSameUser {

    /**
     *
     * @param  [type] $attribute  [description]
     * @param  [type] $value      [description]
     * @param  [type] $parameters [description]
     * @param  [type] $validator  [description]
     * @return [type]             [description]
     */
    public function validate($attribute, $value, $parameters, $validator) {
        if (!Auth::user()->clients()->where($parameters[0], $value)->count()) {
            return true;
        }

        return false;
    }

}
