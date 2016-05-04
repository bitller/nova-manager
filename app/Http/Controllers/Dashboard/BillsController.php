<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use App\User;
use Auth;

/**
 * Handle work with bills.
 *
 * @author Alexandru Bugarin <alexandru.bugarin@gmail.com>
 */
class BillsController extends BaseController {

    /**
     * Render bills page.
     *
     * @return mixed
     */
    public function index() {
        return view('pages.dashboard.bills.index');
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
