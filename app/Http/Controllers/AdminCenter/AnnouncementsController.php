<?php

namespace App\Http\Controllers\AdminCenter;

use App\Http\Controllers\BaseController;
use App\Announcement;
use App\User;
use Illuminate\Http\Request;

/**
 * Handle administration of announcements.
 *
 * @author Alexandru Bugarin <alexandru.bugarin@gmail.com>
 */
class AnnouncementsController extends BaseController {

    /**
     * @var [type]
     */
    protected $validatedFields = ['announcement_title', 'announcement_content', 'action_button_text', 'action_button_url', 'announcement_type'];

    /**
     * Render announcements page.
     */
    public function index() {
        return view('pages.admin-center.announcements');
    }

    /**
     * Get announcement types.
     */
    public function getAnnouncementTypes() {
        return response()->json([
            'types' => Announcement::distinct()->pluck('type')
        ]);
    }

    public function postAnnouncement(Request $request) {

        $this->validatePostAnnouncementData($request);

        $announcement = \App\Announcement::create([
            'title' => $request->get('announcement_title'),
            'content' => $request->get('announcement_content'),
            'action_button_text' => $request->get('action_button_text'),
            'action_button_url' => $request->get('action_button_url')
        ]);

        // Attach announcement to all Users
        $users = User::all();
        foreach ($users as $user) {
            $user->announcements()->attach($announcement);
        }

        return response()->json([
            'title' => 'Succes!',
            'message' => 'Anunțul a fost publicat.'
        ]);
    }

    protected function validatePostAnnouncementData($request) {
        $this->validate($request, [
            'announcement_type' => ['required', 'exists:announcements,type'],
            'announcement_title' => ['required', 'string', 'between:3,50'],
            'announcement_content' => ['required', 'string', 'between:10,500'],
            'action_button_text' => ['required', 'string', 'between:3,50'],
            'action_button_url' => ['required', 'url']
        ]);
    }

}
