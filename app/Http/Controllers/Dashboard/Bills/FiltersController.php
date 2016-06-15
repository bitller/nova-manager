<?php

namespace App\Http\Controllers\Dashboard\Bills;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Auth;
use App\Campaign;

/**
 * Allow user to edit filters applied on bills pagination.
 *
 * @author Alexandru Bugarin <alexandru.bugarin@gmail.com>
 */
class FiltersController extends BaseController {

    /**
     * Fields that are validated by this controller.
     *
     * @var array
     */
    protected $validatedFields = ['type', 'status', 'campaign_number', 'campaign_year'];

    /**
     * User settings.
     *
     * @var null
     */
    protected $settings = null;

    /**
     * Controller constructor.
     */
    public function __construct() {
        parent::__construct();
        $this->settings = Auth::user()->settings()->first();
    }

    /**
     * Retrun filters used when paginating bills.
     *
     * @return Response
     */
    public function filters() {
        return response()->json($this->buildFilters());
    }

    /**
     * Update displayed bills filter (all, current_campaign or custom_campaign).
     *
     * @param  Request $request
     * @return Response
     */
    public function updateDisplayedBillsFilter(Request $request) {

        $this->validateUpdateDisplayedBillsFilter($request);
        $filter = $request->get('type');

        $newFilter = [
            'displayed_bills_filter' => $filter
        ];

        if ($filter === 'current_campaign' || $filter === 'custom_campaign') {
            // Assign id of current campaign
            $newFilter['bills_filter_campaign_id'] = Campaign::current()->first()->id;
        }

        Auth::user()->settings()->update($newFilter);

        return response()->json($this->buildFilters([
            'title' => 'Succes!',
            'message' => 'Filtrul pentru facturile afisate a fost actualizat.'
        ]));
    }

    /**
     * Update bills status filter (all, unpaid and paid).
     *
     * @param  Request $request
     * @return Response
     */
    public function updateBillsStatusFilter(Request $request) {

        $this->validateUpdateBillsStatusFilter($request);

        Auth::user()->settings()->update([
            'bills_status' => $request->get('status')
        ]);

        return response()->json($this->buildFilters([
            'title' => 'Succes!',
            'message' => 'Tipul facturilor afisate a fost actualizat.'
        ]));
    }

    // public function updateCustomCampaign(Request $request) {
    //
    //     $this->validate($reques, [
    //         'campaign_number' => ['required', 'exists:campaigns,number'],
    //         'campaign_year' => ['required', 'exists:campaigns,year']
    //     ]);
    //
    //     $campaign = Campaign::where('number', $request->get('campaign_number'))->where('year', $request->get('campaign_year'))->first();
    //
    //     Auth::user()->settings()->update([
    //         'bills_filter_campaign_id' => $campaign->id
    //     ]);
    //
    //     return response()->json([
    //         'title' => 'Succes!',
    //         'message' => 'Campania a fost selectata.'
    //     ]);
    // }

    /**
     * Update campaign number filter.
     *
     * @param  Request $request
     * @return Response
     */
    public function updateCampaignNumber(Request $request) {

        $this->validateUpdateCampaignNumber($request);
        $campaign = Campaign::where('id', $this->settings->bills_filter_campaign_id)->first();

        // Update campaign
        Auth::user()->settings()->update([
            'bills_filter_campaign_id' => Campaign::where('year', $campaign->year)->where('number', $request->get('campaign_number'))->first()->id
        ]);

        return response()->json($this->buildFilters([
            'title' => 'Succes!',
            'message' => 'Campania a fost actualizata.'
        ]));
    }

    /**
     * Update campaign year filter.
     *
     * @param  Request $request
     * @return Response
     */
    public function updateCampaignYear(Request $request) {

        $this->validateUpdateCampaignYear($request);

        Auth::user()->settings()->update([
            'bills_filter_campaign_id' => Campaign::where('year', $request->get('campaign_year'))->first()->id
        ]);

        return response()->json($this->buildFilters([
            'title' => 'Succes!',
            'message' => 'Campania a fost actualizata.'
        ]));
    }

    protected function buildFilters($otherFields = []) {

        $this->settings = Auth::user()->settings()->first();

        $filters = [
            'displayed_bills' => $this->settings->displayed_bills_filter,
            'bills_status' => $this->settings->bills_status
        ];

        // Check if user want only bills from a specific campaign
        if ($this->settings->displayed_bills_filter !== 'all' && is_numeric($this->settings->bills_filter_campaign_id)) {
            $campaign = Campaign::where('id', $this->settings->bills_filter_campaign_id)->first();
            $filters['campaign_year'] = $campaign->year;
            $filters['campaign_number'] = $campaign->number;
            $filters['campaign_years'] = Campaign::groupBy('year')->get();
            $filters['campaign_numbers'] = Campaign::select('number', 'year')->where('year', $campaign->year)->get();
        }

        if (!count($otherFields)) {
            return $filters;
        }

        return array_merge($otherFields, ['filters' => $filters]);
    }

    /**
     * Validate data used to update bills status filter.
     *
     * @param $request
     */
    protected function validateUpdateBillsStatusFilter($request) {
        $this->validate($request, [
            'status' => ['required', 'string', 'in:all,paid,unpaid']
        ]);
    }

    /**
     * Validate data used to update displayed bills filter.
     *
     * @param $request
     */
    protected function validateUpdateDisplayedBillsFilter($request) {
        $this->validate($request, [
            'type' => ['required', 'in:all,current_campaign,custom_campaign'],
        ]);
    }

    /**
     * Validate data used to update campaign number filter.
     *
     * @param $request
     */
    protected function validateUpdateCampaignNumber($request) {

        $campaign = Campaign::where('id', $this->settings->bills_filter_campaign_id)->first();
        $this->validate($request, [
            'campaign_number' => ['required', 'numeric', 'campaign_number_belongs_to_selected_year:' . $campaign->year]
        ]);
    }

    /**
     * Validate data used to update campaign year filter.
     *
     * @param $request
     */
    protected function validateUpdateCampaignYear($request) {
        $this->validate($request, [
            'campaign_year' => ['requried', 'numeric', 'exists:campaigns,year']
        ]);
    }

}
