<?php

namespace App\Http\Controllers\Dashboard\Settings;

use App\Http\Controllers\BaseController;
use Auth;
use Illuminate\Http\Request;

/**
 * Allow user to edit number of dispalyed clients.
 *
 * @author Alexandru Bugarin <alexandru.bugarin@gmail.com>
 */
class NumberOfClientsController extends BaseController {

    /**
     * Render number of clients settings page.
     */
    public function index() {
        return view('pages.dashboard.settings.number-of-clients');
    }

    /**
     * Get current number of displayed clients.
     */
    public function get() {

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
     * Update number of displayed clients.
     *
     * @param  Request $request
     */
    public function update(Request $request) {

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
