<?php

namespace App\Http\Controllers\Dashboard\Settings;

use App\Http\Controllers\BaseController;

class ProfileController extends BaseController {

    public function index() {
        return view('pages.dashboard.settings.profile');
    }

}
