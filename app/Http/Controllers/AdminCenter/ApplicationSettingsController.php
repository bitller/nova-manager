<?php

namespace App\Http\Controllers\AdminCenter;

use App\Http\Controllers\BaseController;
use App\Http\Requests\AdminCenter\ApplicationSettings\EditLandingPageHeaderTextRequest;
use App\Http\Requests\AdminCenter\ApplicationSettings\EditLandingPageThirdSectionDetailsRequest;
use App\Http\Requests\AdminCenter\ApplicationSettings\EditLandingPageSecondSectionDetailsRequest;
use App\Http\Requests\AdminCenter\ApplicationSettings\EditLandingPageFourthSectionDetailsRequest;
use App\Http\Requests\AdminCenter\ApplicationSettings\EditLandingPageSeventhSectionDetailsRequest;
use App\Http\Requests\AdminCenter\ApplicationSettings\EditLandingPageFifthSectionDetailsRequest;
use App\Http\Requests\AdminCenter\ApplicationSettings\EditLandingPageSixthSectionDetailsRequest;
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

    public function getFourthSectionDetails() {
        return response()->json([
            'title' => $this->applicationSettings->fourth_section_title,
            'description' => $this->applicationSettings->fourth_section_description
        ]);
    }

    public function updateLandingPageFourthSectionDetails(EditLandingPageFourthSectionDetailsRequest $request) {
        ApplicationSetting::where('id', '<', 10000)->update([
            'fourth_section_title' => $request->get('title'),
            'fourth_section_description' => $request->get('description')
        ]);

        return response()->json([
            'title' => 'Succes!',
            'message' => 'A patra sectiune a paginii a fost actualizata.'
        ]);
    }

    public function getFifthSectionDetails() {
        return response()->json([
            'title' => $this->applicationSettings->fifth_section_title,
            'description' => $this->applicationSettings->fifth_section_description
        ]);
    }

    public function updateLandingPageFifthSectionDetails(EditLandingPageFifthSectionDetailsRequest $request) {
        $this->updateLandingPageGivenSectionDetails('fifthSection', $request);
        return response()->json([
            'title' => 'Succes!',
            'message' => 'A cincea sectiune a paginii a fost actualizata.'
        ]);
    }

    public function getSixthSectionDetails() {
        return response()->json([
            'title' => $this->applicationSettings->sixth_section_title,
            'description' => $this->applicationSettings->sixth_section_description
        ]);
    }

    public function updateLandingPageSixthSectionDetails(EditLandingPageSixthSectionDetailsRequest $request) {
        $this->updateLandingPageGivenSectionDetails('sixthSection', $request);
        return response()->json([
            'title' => 'Succes!',
            'message' => 'A sasea sectiunea a paginii a fost actualizata.'
        ]);
    }

    public function getSeventhSectionDetails() {
        return response()->json([
            'title' => $this->applicationSettings->seventh_section_title,
            'description' => $this->applicationSettings->seventh_section_title
        ]);
    }

    public function updateLandingPageSeventhSectionDetails(EditLandingPageSeventhSectionDetailsRequest $request) {
        $this->updateLandingPageGivenSectionDetails('seventhSection', $request);
        return response()->json([
            'title' => 'Succes!',
            'message' => 'A saptea sectiune a paginii a fost actualizata.'
        ]);
    }

    private function updateLandingPageGivenSectionDetails($section, $request) {
        $fields = [];

        switch ($section) {
            case 'headerText':
                $fields['landing_index_title'] = $request->get('header_text');
                break;
            case 'secondSection':
                $fields['second_section_title'] = $request->get('title');
                $fields['second_section_description'] = $request->get('description');
                $fields['second_section_button_text'] = $request->get('button_text');
                break;
            case 'thirdSection':
                $fields['third_section_title'] = $request->get('title');
                $fields['third_section_description'] = $request->get('description');
                break;
            case 'fourthSection':
                $fields['fourth_section_title'] = $request->get('title');
                $fields['fourth_section_description'] = $request->get('description');
                break;
            case 'fifthSection':
                $fields['fifth_section_title'] = $request->get('title');
                $fields['fifth_section_description'] = $request->get('description');
                break;
        }
        ApplicationSetting::where('id', '<', 10000)->update($fields);
    }
}
