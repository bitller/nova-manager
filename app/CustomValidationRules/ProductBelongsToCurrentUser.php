<?php

namespace App\CustomValidationRules;

use Auth;

/**
 * Usage: product_belongs_to_current_user.
 *
 * @author Alexandru Bugarin <alexandru.bugarin@gmail.com>
 */
class ProductBelongsToCurrentUser {

    /**
     * @param  $attribute
     * @param  $value
     * @param  $parameters
     * @param  $validator
     * @return bool
     */
    public function validate($attribute, $value, $parameters, $validator) {
        return Auth::user()->products()->where('id', $value)->count();
    }

}
