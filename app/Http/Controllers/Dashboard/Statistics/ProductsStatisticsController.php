<?php

namespace App\Http\Controllers\Dashboard\Statistics;

use App\Http\Controllers\BaseController;

/**
 * Statistics about products.
 *
 * @author Alexandru Bugarin <alexandru.bugarin@gmail.com>
 */
class ProductsStatisticsController extends BaseController {

    public function general() {
        return view('pages.dashboard.statistics.general.products');
    }

    public function campaign() {
        return view('pages.dashboard.statistics.campaign.products');
    }

}
