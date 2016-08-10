<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;
use Auth;
use App\ApplicationSetting;

class LandingController extends BaseController {

    public function __construct() {
        if (Auth::check()) {
            return redirect('/dashboard');
        }
    }

    public function index() {

        $appSettings = ApplicationSetting::first();
        return view('pages.landing.index')->with('settings', $appSettings);
    }

}
