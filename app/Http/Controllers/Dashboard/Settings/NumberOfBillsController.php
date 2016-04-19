<?php

namespace App\Http\Controllers\Dashboard\Settings;

use App\Http\Controllers\BaseController;
use Auth;
use Illuminate\Http\Request;

/**
 * Allow user to change number of displayed bills.
 *
 * @author Alexandru Bugarin <alexandru.bugarin@gmail.com>
 */
class NumberOfBillsController extends BaseController {

    /**
     * Render number of bills setting page.
     */
    public function index() {
        return view('pages.dashboard.settings.number-of-bills');
    }

    /**
     * Get number of displayed bills.
     */
    public function get() {
        sleep(3);
        $numberOfBills = Auth::user()->settings()->first()->number_of_bills;

        if (!$numberOfBills || !is_numeric($numberOfBills) || $numberOfBills < 1) {
            return response()->json([
                'message' => 'Numarul curent de facturi afisate nu este corect.'
            ], 422);
        }

        return response()->json([
            'number_of_bills' => $numberOfBills
        ]);
    }

    /**
     * Update number of displayed bills.
     *
     * @param  inate\Http\Request
     */
    public function update(Request $request) {

        $this->validateDataUsedToEditNumberOfBills($request);
        $numberOfBills = $request->get('number_of_bills');

        Auth::user()->settings()->update([
            'number_of_bills' => $numberOfBills
        ]);

        return response()->json([
            'message' => 'Numarul de facturi afisate a fost actualizat!',
            'title' => 'Succes!',
            'number_of_bills' => $numberOfBills
        ]);
    }

    /**
     * Validate data used to edit number of bills.
     *
     * @param  $request inate\Http\Request
     */
    protected function validateDataUsedToEditNumberOfBills($request) {
        $this->validate($request, [
            'number_of_bills' => ['required', 'numeric', 'between:5,100']
        ]);
    }

}
