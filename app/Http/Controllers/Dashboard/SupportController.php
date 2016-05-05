<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\BaseController;

/**
 * Handle customers support.
 *
 * @author Alexandru Bugarin <alexandru.bugarin@gmail.com>
 */
class SupportController extends BaseController {

    public function index() {
        return view('pages.dashboard.support.index');
    }

}
