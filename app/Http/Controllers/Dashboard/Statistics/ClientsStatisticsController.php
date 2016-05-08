<?php

namespace App\Http\Controllers\Dashboard\Statistics;

use App\Http\Controllers\BaseController;

/**
 * Statistics about clients.
 *
 * @author Alexandru Bugarin <alexandru.bugarin@gmail.com>
 */
class ClientsStatisticsController extends BaseController {

    public function general() {
        return view('pages.dashboard.statistics.general.clients');
    }

    public function campaign() {
        return view('pages.dashboard.statistics.campaign.clients');
    }

}
