<?php

namespace App\Http\Controllers\AdminCenter;

use App\Http\Controllers\BaseController;

/**
 * Handle administration of announcements.
 *
 * @author Alexandru Bugarin <alexandru.bugarin@gmail.com>
 */
class AnnouncementsController extends BaseController {

    /**
     * Render announcements page.
     */
    public function index() {
        return view('pages.admin-center.announcements');
    }
    
}
