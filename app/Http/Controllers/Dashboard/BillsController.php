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
            'bills.campaign_order', 'campaign.number as campaign_number', 'campaign.year as campaign_year'
            // DB::raw('SUM(products.final_price) as final_price')
        )->leftJoin('clients as client', 'client.id', '=', 'bills.client_id')
        ->leftJoin('campaigns as campaign', 'campaign.id', '=', 'bills.campaign_id');
        // ->leftJoin('bill_products as bill_product', 'bill_product.bill_id', '=', 'bills.id')
        // ->leftJoin('products as product', 'product.id', '=', 'bill_product.product_id');


        // Check if only bills from current campaign should be paginated
        if ($this->settings->displayed_bills_filter === $this->campaign['current']) {
            $pagination->where('campaign_id', Campaign::current()->first()->id);

        // Or only bills from a selected campaign
        } else if ($this->settings->displayed_bills_filter === $this->campaign['custom']) {
            $pagination->where('campaign_id', Campaign::where('id', $this->settings->bills_filter_campaign_id));
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
     * @param  nate\Http\Request $request
     */
    protected function validateNewBillData($request) {
        $this->validate($request, [
            'client_name' => ['required', 'string', 'between:3,50']
        ]);
    }

}
