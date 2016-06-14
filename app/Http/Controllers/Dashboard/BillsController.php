<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use App\User;
use Auth;
use App\Campaign;
use DB;

/**
 * Handle work with bills.
 *
 * @author Alexandru Bugarin <alexandru.bugarin@gmail.com>
 */
class BillsController extends BaseController {

    protected $validatedFields = ['type', 'campaign_number', 'campaign_year'];

    /**
     * User settings.
     *
     * @var null
     */
    protected $settings = null;

    protected $campaign = [
        'current' => 'current_campaign',
        'custom' => 'custom_campaign'
    ];

    protected $billsStatus = [
        'paid' => 'paid',
        'unpaid' => 'unpaid',
        'all' => 'all'
    ];

    public function __construct() {
        parent::__construct();
        $this->settings = Auth::user()->settings()->first();
    }

    /**
     * Render bills page.
     *
     * @return mixed
     */
    public function index() {
        return view('pages.dashboard.bills.index');
    }

    public function paginate(Request $request) {

        $pagination = Auth::user()->bills()->select(
            'bills.payment_term', 'client.name as client_name',
            'bills.campaign_order', 'campaign.number as campaign_number', 'campaign.year as campaign_year',
            DB::raw('sum(bill_product.price) as price'), DB::raw('sum(bill_product.quantity) as quantity')
        )->leftJoin('clients as client', 'client.id', '=', 'bills.client_id')
        ->leftJoin('campaigns as campaign', 'campaign.id', '=', 'bills.campaign_id')
        ->leftJoin('bill_products as bill_product', 'bill_product.bill_id', '=', 'bills.id')
        ->groupBy('bill_product.bill_id')
        ->leftJoin('products as product', 'product.id', '=', 'bill_product.product_id');


        // Check if only bills from current campaign should be paginated
        if ($this->settings->displayed_bills_filter === $this->campaign['current']) {
            $pagination->where('campaign_id', Campaign::current()->first()->id);

        // Or only bills from a selected campaign
        } else if ($this->settings->displayed_bills_filter === $this->campaign['custom']) {
            $pagination->where('campaign_id', Campaign::where('id', $this->settings->bills_filter_campaign_id)->first()->id);
        }

        // Else paginate bills from all campaigns

        // Check if only paid bills should be paginated
        if ($this->settings->bills_status === $this->billsStatus['paid']) {
            $pagination->where('paid', true);

        // Check if only unpiad bills should be paginated
        } else if ($this->settings->bills_status == $this->billsStatus['unpaid']) {
            $pagination->where('paid', false);
        }

        // Else paginate paid and unpaid bills

        return $pagination->paginate(10);
    }

    public function getFilters() {

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

        return response()->json($filters);
    }

    public function get($clientName) {
        //
    }

    public function createNewBill(Request $request) {

        $this->validateNewBillData($request);

        $client = User::clients()->where('name', $request->get('client_name'))->first();

        // Craete new client if does not exists
        if (!$client) {
            $client = User::clients()->save([
              'name' => $request->get('client_name')
            ]);
        }

        // Check if current campaign should be used
        if ($request->has('use_current_campaign')) {
            //
        } else {
            //
        }

        $bill = $client->bills()->save([
            'other_details' => 'bau'
        ]);
    }

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

        return response()->json([
            'title' => 'Succes!',
            'message' => 'Filtrul pentru facturile afisate a fost actualizat.'
        ]);
    }

    public function updateBillsStatusFilter(Request $request) {

        $this->validateUpdateBillsStatusFilter($request);

        Auth::user()->settings()->update([
            'bills_status' => $request->get('status')
        ]);

        return response()->json([
            'title' => 'Succes!',
            'message' => 'Tipul facturilor afisate a fost actualizat.'
        ]);
    }

    public function updateCustomCampaign(Request $request) {

        $this->validate($reques, [
            'campaign_number' => ['required', 'exists:campaigns,number'],
            'campaign_year' => ['required', 'exists:campaigns,year']
        ]);

        $campaign = Campaign::where('number', $request->get('campaign_number'))->where('year', $request->get('campaign_year'))->first();

        Auth::user()->settings()->update([
            'bills_filter_campaign_id' => $campaign->id
        ]);

        return response()->json([
            'title' => 'Succes!',
            'message' => 'Campania a fost selectata.'
        ]);
    }

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

        return response()->json([
            'title' => 'Succes!',
            'message' => 'Campania a fost actualizata.'
        ]);
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

        return response()->json([
            'title' => 'Succes!',
            'message' => 'Campania a fost actualizata.'
        ]);
    }

    public function bill($billId, Request $request) {
        return view('pages.dashboard.bills.bill');
    }

    public function deleteBill() {
      //
    }

    public function suggestClients(Request $request) {
        return Auth::user()->clients()->paginate(10);
    }

    /**
     * Validate data used to create a new bill.
     *
     * @param  Illuminate\Http\Request $request
     */
    protected function validateNewBillData($request) {
        $this->validate($request, [
            'client_name' => ['required', 'string', 'between:3,50']
        ]);
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
