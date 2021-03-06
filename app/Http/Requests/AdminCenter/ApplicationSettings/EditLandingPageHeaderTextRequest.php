<?php

namespace App\Http\Requests\AdminCenter\ApplicationSettings;

use Auth;
use App\Http\Requests\Request;

/**
 * Validate data used to edit landing page header text.
 *
 * @author Alexandru Bugarin <alexandru.bugarin@gmail.com>
 */
class EditLandingPageHeaderTextRequest extends Request {

    /**
     * @return bool
     */
    public function authorize() {
        return Auth::user()->hasRole('admin');
    }

    /**
     * Validation rules.
     *
     * @return array
     */
    public function rules() {
        return [
            'header_text' => ['required', 'string', 'between:5, 100']
        ];
    }

}
