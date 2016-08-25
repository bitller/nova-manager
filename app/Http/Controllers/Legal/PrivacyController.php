<?php

namespace App\Http\Controllers\Legal;

use App\Http\Controllers\BaseController;

/**
 * Privacy page.
 *
 * @author Alexandru Bugarin <alexandru.bugarin@gmail.com>
 */
class PrivacyController extends BaseController {

    public function index() {
        return view('pages.legal.privacy');
    }

}
