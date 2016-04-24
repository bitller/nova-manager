<?php

namespace App\Http\Controllers\AdminCenter;

use App\Http\Controllers\BaseController;

/**
 * Generate statistics about subscriptions.
 *
 * @author Alexandru Bugarin <alexandru.bugarin@gmail.com>
 */
class SubscriptionsMetricsController extends BaseController {

    /**
     * Render subscriptions metrics page.
     */
    public function index() {
        return view('pages.admin-center.subscriptions-metrics');
    }

}
