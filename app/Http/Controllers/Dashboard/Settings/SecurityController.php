<?php

namespace App\Http\Controllers\Dashboard\Settings;

use App\Http\Controllers\BaseController;

class SecurityController extends BaseController {
    public function index() {
        return view('pages.dashboard.settings.security');
    }
}
