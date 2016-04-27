<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Auth;

/**
 * Handle work with clients.
 *
 * @author Alexandru Bugarin <alexandru.bugarin@gmail.com>
 */
class ClientsController extends BaseController {

    /**
     * Render clients page.
     */
    public function index(Request $request) {
        return view('pages.dashboard.clients.index');
    }

    /**
     * Paginate clients.
     */
    public function paginateClients() {
        // return Auth::user()->clients()->paginate(Auth::user()->settings()->first()->number_of_clients);
        return Auth::user()->clients()->paginate(4);
    }

    /**
     * Add new client.
     *
     * @param Request $request
     */
    public function addClient(Request $request) {
        $this->validateAddClientData($request);

        Auth::user()->clients()->save(new Client($request->only('name', 'phone_number', 'email', 'wish_happy_birth_day')));

        return response()->json([
            'title' => 'Succes!',
            'message' => 'Clientul a fost adăugat.'
        ]);
    }

    /**
     * Delete client.
     *
     * @param  int $clientId
     */
    public function deleteClient($clientId) {
        
        // Make sure the client belong to the current user
        if (!Auth::user()->clients()->where('id', $clientId)->count()) {
            return response()->json([
                'title' => 'O eroare a avut loc.',
                'message' => 'Acest client nu vă aparține',
            ], 422);
        }

        Auth::user()->clients()->where('id', $clientId)->delete();

        return response()->json([
            'title' => 'Succes!',
            'message' => 'Clientul a fost șters, împreună cu toate facturile sale',
        ]);
    }

    /**
     * Validate data used to add a new client.
     *
     * @param Request $request
     */
    public function validateAddClientData($request) {
        $this->validate($request, [
            'name' => ['required', 'string', 'between:3,100'],
            'phone_number' => ['required', 'string', 'size:10', 'not_belongs_to_another_client_of_same_user:phone_number'],
            'email' => ['required', 'email', 'not_belongs_to_another_client_of_same_user:email']
        ]);
    }

}
