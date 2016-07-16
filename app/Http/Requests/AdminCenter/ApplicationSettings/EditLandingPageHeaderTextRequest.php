<?php

namespace App\Http\Requests\AdminCenter\ApplicationSettings;

use Auth;
use App\Http\Requests\Request;

class EditLandingPageHeaderTextRequest extends Request {

    public function authorize() {
        return Auth::user()->hasRole('admin');
    }

    public function rules() {
        return [
            'header_text' => ['required', 'string', 'between:5, 100']
        ];
    }

}
