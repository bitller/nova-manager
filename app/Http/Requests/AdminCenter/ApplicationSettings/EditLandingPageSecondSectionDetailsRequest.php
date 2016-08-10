<?php

namespace App\Http\Requests\AdminCenter\ApplicationSettings;

use Auth;
use App\Http\Requests\Request;

/**
 * Validate data used to edit landing page second section.
 *
 * @author Alexandru Bugarin <alexandru.bugarin@gmail.com>
 */
class EditLandingPageSecondSectionDetailsRequest extends Request {

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
            'title' => ['required', 'string', 'between:5,50'],
            'description' => ['required', 'string', 'between:5,200'],
            'button_text' => ['required', 'string', 'between:5,50']
        ];
    }

}
