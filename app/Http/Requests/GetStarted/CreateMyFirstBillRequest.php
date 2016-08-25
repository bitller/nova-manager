<?php

namespace App\Http\Requests\GetStarted;

use App\Http\Requests\Request;

/**
 * Validate data used to create user first bill.
 *
 * @author Alexandru Bugarin <alexandru.bugarin@gmail.com>
 */
class CreateMyFirstBillRequest extends Request {

    public function authorize() {
        return true;
    }

    public function rules() {
        return [
            'client_name' => ['required', 'string', 'between:3,50']
        ];
    }

}
