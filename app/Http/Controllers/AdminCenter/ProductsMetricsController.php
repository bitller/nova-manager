<?php

namespace App\Http\Controllers\AdminCenter;

use App\Http\Controllers\BaseController;

/**
 * Metrics for products.
 *
 * @author Alexandru Bugarin <alexandru.bugarin@gmail.com>
 */
class ProductsMetricsController extends BaseController {

    /**
     * Render products metrics page.
     */
    public function index() {
        return view('pages.admin-center.products-metrics');
    }
    
}
