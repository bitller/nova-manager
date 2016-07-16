<?php

namespace App\Http\Controllers\AdminCenter;

use App\Http\Controllers\BaseController;
use App\Http\Requests\AdminCenter\ApplicationSettings\EditLandingPageHeaderTextRequest;
use App\ApplicationSetting;

/**
 * Handle work with application settings.
 *
 * @author Alexandru Bugarin <alexandru.bugarin@gmail.com>
 */
class ApplicationSettingsController extends BaseController {

    /**
     * Render application settings page.
     */
    public function index() {
        return view('pages.admin-center.application-settings');
    }

    public function getCurrentLandingPageHeaderText() {
        return response()->json([
            'header_text' => ApplicationSetting::first()->landing_index_title
        ]);
    }

    public function updateLandingPageHeaderText(EditLandingPageHeaderTextRequest $request) {

        ApplicationSetting::where('id', '<', 10000)->update([
            'landing_index_title' => $request->get('header_text')
        ]);

        return response()->json([
            'title' => 'Succes!',
            'message' => 'Antetul primei pagini a fost actualizat.'
        ]);
    }

}
