<?php

namespace App\Http\Controllers\Dashboard\Settings;

use App\Http\Controllers\BaseController;

/**
 * Allow user to manage credit card.
 *
 * @author Alexandru Bugarin <alexandru.bugarin@gmail.com>
 */
class CreditCardController extends BaseController {

    /**
     * Render credit card view.
     */
    public function index() {
        return view('pages.dashboard.settings.credit-card');
    }
    
}
