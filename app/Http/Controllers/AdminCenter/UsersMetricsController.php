<?php

namespace App\Http\Controllers\AdminCenter;

use App\Http\Controllers\BaseController;

/**
 * Generate statistics about users.
 *
 * @author Alexandru Bugarin <alexandru.bugarin@gmail.com>
 */
class UsersMetricsController extends BaseController {

    /**
     * Render users metrics page.
     */
    public function index() {
        return view('pages.admin-center.users-metrics');
    }

}
