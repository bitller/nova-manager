<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;
use Auth;

class LandingController extends BaseController {

    public function __construct() {
        if (Auth::check()) {
            return redirect('/dashboard');
        }
    }

    public function index() {
        return view('pages.landing.index');
    }

}
