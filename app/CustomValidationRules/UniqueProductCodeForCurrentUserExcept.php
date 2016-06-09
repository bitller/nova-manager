<?php

namespace App\CustomValidationRules;

use Auth;

/**
 * Usage: unique_product_code_for_current_user_except:product_id.
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
        if (Auth::user()->products()->where('code', $value)->count() > 1) {
            return false;
        }

        return true;
    }

}
