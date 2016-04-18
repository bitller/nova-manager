<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;

/**
 * Handle dashboard home page.
 */
class HomeController extends Controller {
    
    public function index() {
        return view('pages.dashboard.home.index');
    }
    
}