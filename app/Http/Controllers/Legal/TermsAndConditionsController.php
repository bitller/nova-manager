<?php

namespace App\Http\Controllers\Legal;

use App\Http\Controllers\BaseController;

/**
 * Terms and conditions page.
 *
 * @author Alexandru Bugarin <alexandru.bugarin@gmail.com>
 */
class TermsAndConditionsController extends BaseController {

    public function index() {
        return view('pages.legal.terms');
    }

}
