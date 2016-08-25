<?php

namespace App\Http\Controllers\AdminCenter;

use App\Http\Controllers\BaseController;

/**
 * Admin center tickets sections.
 *
 * @author Alexandru Bugarin <alexandru.bugarin@gmail.com>
 */
class TicketsController extends BaseController {

    public function index() {
        return view('pages.admin-center.tickets');
    }

}
