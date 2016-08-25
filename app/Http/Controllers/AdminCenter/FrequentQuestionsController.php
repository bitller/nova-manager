<?php

namespace App\Http\Controllers\AdminCenter;

use App\Http\Controllers\BaseController;

/**
 * Admin page frequent questions section.
 *
 * @author Alexandru Bugarin <alexandru.bugarin@gmail.com>
 */
class FrequentQuestionsController extends BaseController {

    public function index() {
        return view('pages.admin-center.frequent-questions');
    }

}
