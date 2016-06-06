<?php

namespace App\CustomValidationRules;

use Auth;

/**
 * Usage: unique_product_code_for_current_user.
 *
 * @author Alexandru Bugarin <alexandru.bugarin@gmail.com>
 */
class UniqueProductCodeForCurrentUser {

    /**
     * @param  $attribute
     * @param  $value
     * @param  $parameters
     * @param  $validator
     * @return bool
     */
    public function validate($attribute, $value, $parameters, $validator) {
        return ! Auth::user()->products()->where('code', $value)->count();
    }

}
