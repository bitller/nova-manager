<?php

namespace App\Http\Controllers\Dashboard\Bills;

use App\Http\Controllers\BaseController;
use Auth;
use App\Campaign;
use DB;
use Illuminate\Http\Request;
use App\Client;
use App\Bill;

/**
 * Bills page controller.
 *
 * @author Alexandru Bugarin <alexandru.bugarin@gmail.com>
 */
class IndexController extends BaseController {

    protected $validatedFields = ['client_name'];

    /**
     * User settings.
     *
     * @var null
     */
    protected $settings = null;

    /**
     * Campaign strings used in comparations.
     *
     * @var array
     */
    protected $campaign = [
        'current' => 'current_campaign',
        'custom' => 'custom_campaign'
    ];

    /**
     * Bills status strings used in comparations.
     *
     * @var array
     */
    protected $billsStatus = [
        'paid' => 'paid',
        'unpaid' => 'unpaid',
        'all' => 'all'
    ];

    /**
     * Controller constructor.
     */
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

    /**
     * Paginte bills based on given filter.
     *
     * @param  Request $request
     * @return Response
     */
    public function paginate(Request $request) {

        $pagination = Auth::user()->bills()->select(
            'bills.payment_term', 'client.name as client_name',
            'bills.campaign_order', 'campaign.number as campaign_number', 'campaign.year as campaign_year',
            DB::raw('sum(bill_product.price) as price'), DB::raw('sum(bill_product.quantity) as quantity')
        )->leftJoin('clients as client', 'client.id', '=', 'bills.client_id')
        ->leftJoin('campaigns as campaign', 'campaign.id', '=', 'bills.campaign_id')
        ->leftJoin('bill_products as bill_product', 'bill_product.bill_id', '=', 'bills.id')
        ->groupBy('bills.id')
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

        return $pagination->orderBy('bills.created_at', 'desc')->paginate(10);
    }

    /**
     * Allow user to create new bill.
     *
     * @param  Request $request
     * @return Response
     */
    public function create(Request $request) {

        $this->validateCreateBillData($request);

        $client = Auth::user()->clients()->where('name', $request->get('client_name'))->first();

        // Create new client if does not exists
        if (!$client) {
            $client = Auth::user()->clients()->save(new Client([
              'name' => $request->get('client_name')
            ]));
        }

        // Create bill
        $bill = $client->bills()->save(new Bill([
            'campaign_id' => Campaign::current()->first()->id
        ]));

        return response()->json([
            'title' => 'Succes!',
            'message' => 'Factura a fost creată.'
        ]);
    }

    /**
     * Suggest clients when a new bill is created.
     *
     * @param  Request $request
     * @return Response
     */
    public function suggestClients(Request $request) {
        return Auth::user()->clients()->where('name', 'like', $request->get('query') . '%')->take(10)->get();
    }

    public function delete() {
        //
    }

    /**
     * Validate data used to create a new bill.
     *
     * @param  Illuminate\Http\Request $request
     */
    protected function validateCreateBillData($request) {
        $this->validate($request, [
            'client_name' => ['required', 'string', 'between:3,50']
        ]);
    }

}
