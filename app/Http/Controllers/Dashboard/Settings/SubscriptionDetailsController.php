<?php

namespace App\Http\Controllers\Dashboard\Settings;

use App\Http\Controllers\BaseController;

/**
 * Allow user to manage subscriptions.
 *
 * @author Alexandru Bugarin <alexandru.bugarin@gmail.com>
 */
class SubscriptionDetailsController extends BaseController {

    /**
     * Render subscription details page.
     */
    public function index() {
        return view('pages.dashboard.settings.subscription-details');
    }
    
}
