<?php

namespace App\Http\Requests\AdminCenter\ApplicationSettings;

use App\Http\Requests\Request;
use Auth;

/**
 * @author Alexandru Bugarin <alexandru.bugarin@gmail.com>
 */
class EditLandingPageSixthSectionDetailsRequest extends Request {

    public function authorize() {
        return Auth::user()->hasRole('admin');
    }

    public function rules() {
        return [
            'title' => ['required', 'string', 'between:5,50'],
            'description' => ['required', 'string', 'between:5,200']
        ];
    }

}
