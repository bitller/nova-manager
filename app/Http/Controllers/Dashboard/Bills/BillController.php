<?php

namespace App\Http\Controllers\Dashboard\Bills;

use App\Http\Controllers\BaseController;

/**
 * Bill page controller.
 *
 * @author Alexandru Bugarin <alexandru.bugarin@gmail.com>
 */
class BillController extends BaseController {

    /**
     * Render page of given bill.
     *
     * @param  int  $billId
     * @param  Request $request
     * @return View
     */
    public function index($billId, Request $request) {
        return view('pages.dashboard.bills.bill');
    }

}
