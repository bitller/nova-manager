<?php

namespace App\Http\Controllers\Dashboard\Settings;

use App\Http\Controllers\BaseController;

/**
 * Allow user to see their payments history and manage extra billing information.
 *
 * @author Alexandru Bugarin <alexandru.bugarin@gmail.com>
 */
class PaymentsController extends BaseController {

    /**
     * Render payments page.
     */
    public function index() {
        return view('pages.dashboard.settings.payments');
    }

}
