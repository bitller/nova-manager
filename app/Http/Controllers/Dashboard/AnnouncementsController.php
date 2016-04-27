<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\BaseController;
use Auth;
use App\Announcement;
use Illuminate\Http\Request;

/**
 * Handle announcements.
 *
 * @author Alexandru Bugarin <alexandru.bugarin@gmail.com>
 */
class AnnouncementsController extends BaseController {

    public function get() {
        return response()->json([
            'announcements' => Auth::user()->notReadAnnouncements()->get()
        ]);
    }

    public function makeNotificationsRead() {

        $notReadAnnouncements = Auth::user()->notReadAnnouncements()->get();
        info(count($notReadAnnouncements));
        $counter = 1;
        foreach ($notReadAnnouncements as $notReadAnnouncement) {
            $counter++;
            info('inside loop ' . $counter);
            Auth::user()->announcements()->updateExistingPivot($notReadAnnouncement->id, ['read' => true]);
        }
    }

}
