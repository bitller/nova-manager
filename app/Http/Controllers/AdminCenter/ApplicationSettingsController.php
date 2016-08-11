<?php

namespace App\Http\Controllers\AdminCenter;

use App\Http\Controllers\BaseController;
use App\Http\Requests\AdminCenter\ApplicationSettings\EditLandingPageHeaderTextRequest;
use App\Http\Requests\AdminCenter\ApplicationSettings\EditLandingPageThirdSectionDetailsRequest;
use App\Http\Requests\AdminCenter\ApplicationSettings\EditLandingPageSecondSectionDetailsRequest;
use App\ApplicationSetting;

/**
 * Handle work with application settings.
 *
 * @author Alexandru Bugarin <alexandru.bugarin@gmail.com>
 */
class ApplicationSettingsController extends BaseController {

    /**
     * Application settings.
     *
     * @var null
     */
    protected $applicationSettings = null;

    public function __construct() {
        parent::__construct();
        $this->applicationSettings = ApplicationSetting::first();
    }

    /**
     * Render application settings page.
     */
    public function index() {
        return view('pages.admin-center.application-settings');
    }

    public function getCurrentLandingPageHeaderText() {
        return response()->json([
            'header_text' => $this->applicationSettings->landing_index_title
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

    public function getSecondSectionDetails() {
        return response()->json([
            'title' => $this->applicationSettings->second_section_title,
            'description' => $this->applicationSettings->second_section_description,
            'button_text' => $this->applicationSettings->second_section_button_text
        ]);
    }

    public function updateLandingPageSecondSectionDetails(EditLandingPageSecondSectionDetailsRequest $request) {
        ApplicationSetting::where('id', '<', 10000)->update([
            'second_section_title' => $request->get('title'),
            'second_section_description' => $request->get('description'),
            'second_section_button_text' => $request->get('button_text')
        ]);

        return response()->json([
            'title' => 'Succes!',
            'message' => 'A doua sectiune a paginii a fost actualizata.'
        ]);
    }

    public function getThirdSectionDetails() {
        return response()->json([
            'title' => $this->applicationSettings->third_section_title,
            'description' => $this->applicationSettings->third_section_description
        ]);
    }

    public function updateLandingPageThirdSectionDetails(EditLandingPageThirdSectionDetailsRequest $request) {
        ApplicationSetting::where('id', '<', 10000)->update([
            'third_section_title' => $request->get('title'),
            'third_section_description' => $request->get('description')
        ]);

        return response()->json([
            'title' => 'Succes!',
            'message' => 'A treia sectiune a paginii a fost actualizata.'
        ]);
    }
}
