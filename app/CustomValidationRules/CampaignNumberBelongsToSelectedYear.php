<?php

namespace App\CustomValidationRules;

use App\Campaign;

class CampaignNumberBelongsToSelectedYear {

    /**
     * @param $attribute
     * @param $value
     * @param $parameters
     * @param $validator
     * @return bool
     */
    public function validate($attribute, $value, $parameters, $validator) {

        if (Campaign::where('year', $parameters[0])->where('number', $value)->count()) {
            return true;
        }

        return false;
    }
}
