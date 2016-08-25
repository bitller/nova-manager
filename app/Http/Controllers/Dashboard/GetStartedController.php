<?php

namespace App\Http\Controllers\Dashboard;

use Auth;
use App\Client;
use App\Campaign;
use App\Bill;
use App\Http\Controllers\BaseController;
use App\Http\Requests\GetStarted\CreateMyFirstBillRequest;

/**
 * Get started page.
 *
 * @author Alexandru Bugarin <alexandru.bugarin@gmail.com>
 */
class GetStartedController extends BaseController {

    public function index() {
        return view('pages.dashboard.get-started');
    }

    public function createMyFirstBill(CreateMyFirstBillRequest $request) {
        $client = Auth::user()->clients()->where('name', $request->get('client_name'))->first();

        // Create new client if does not exists
        if (!$client) {
            $client = Auth::user()->clients()->save(new Client([
              'name' => $request->get('client_name')
            ]));
        }

        // Create bill
        $bill = $client->bills()->save(new Bill([
            'campaign_id' => Campaign::current()->first()->id,
            'payment_term' => '0000-00-00'
        ]));

        return response()->json([
            'title' => 'Succes!',
            'message' => 'Prima ta factură tocmai a fost creată.',
            'redirect_url' => '/dashboard/bills/' . $bill->id . '?first_bill=true'
        ]);
    }

}
