<?php

namespace App\Http\Controllers\Dashboard\Settings;

use App\Http\Controllers\BaseController;
use Auth;
use Illuminate\Http\Request;

/**
 * Allow user to change settings of displayed items.
 *
 * @author Alexandru Bugarin <alexandru.bugarin@gmail.com>
 */
class DisplayedController extends BaseController {

    /**
     * Render displayed page.
     */
    public function index() {
        return view('pages.dashboard.settings.displayed');
    }

    /**
     * Get current number of clients.
     */
    public function getNumberOfClients() {
        $numberOfClients = Auth::user()->settings()->first()->number_of_clients;

        if (!$numberOfClients || !is_numeric($numberOfClients) || $numberOfClients < 1) {
            return response()->json([
                'message' => 'Numarul curent de clienti afisati nu este corect.'
            ], 422);
        }

        return response()->json([
            'number_of_clients' => $numberOfClients
        ]);
    }

    /**
     * Get current number of bills.
     */
    public function getNumberOfBills() {
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
     * Update number of displayed clients.
     *
     * @param  Request $request
     */
    public function updateNumberOfClients(Request $request) {
        $this->validateDataUsedToEditNumberOfClients($request);
        $numberOfClients = $request->get('number_of_clients');

        Auth::user()->settings()->update([
            'number_of_clients' => $numberOfClients
        ]);

        return response()->json([
            'message' => 'Numarul de clienti afisati a fost actualizat!',
            'title' => 'Succes!',
            'number_of_clients' => $numberOfClients
        ]);
    }

    /**
     * Update number of displayed bills.
     *
     * @param  Request $request
     */
    public function updateNumberOfBills(Request $request) {
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

    /**
     * Validate data used to edit number of displayed cients.
     *
     * @param  Illuminate\Http\Request
     */
    protected function validateDataUsedToEditNumberOfClients($request) {
        $this->validate($request, [
            'number_of_clients' => ['required', 'numeric', 'between:5,100']
        ]);
    }
}
