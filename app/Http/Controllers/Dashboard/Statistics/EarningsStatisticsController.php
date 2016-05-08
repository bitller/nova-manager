<?php

namespace App\Http\Controllers\Dashboard\Statistics;

use App\Http\Controllers\BaseController;

/**
 * Statistics about earnings.
 *
 * @author Alexandru Bugarin <alexandru.bugarin@gmail.com>
 */
class EarningsStatisticsController extends BaseController {

    public function general() {
        return view('pages.dashboard.statistics.general.earnings');
    }

    public function campaign() {
        return view('pages.dashboard.statistics.campaign.earnings');
    }

}
