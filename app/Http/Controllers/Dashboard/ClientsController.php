<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\BaseController;
use App\Http\JsonResponses\ClientJsonResponses;
use Illuminate\Http\Request;
use Auth;
use App\Client;

/**
 * Handle work with clients.
 *
 * @author Alexandru Bugarin <alexandru.bugarin@gmail.com>
 */
class ClientsController extends BaseController {

    /**
     * @var array
     */
    protected $validatedFields = ['client_name', 'client_email', 'client_phone_number', 'wish_happy_birth_day', 'birth_day'];

    /**
     * Render clients page.
     */
    public function index() {
        return view('pages.dashboard.clients.index');
    }

    /**
     * Render client page.
     */
    public function client($cliendId) {
        return view('pages.dashboard.clients.client')->with('clientId', $cliendId);
    }

    /**
     * Paginate clients.
     */
    public function paginateClients(Request $request) {

        $searchQuery = $request->get('search-query');
        $perPage = Auth::user()->settings()->first()->number_of_clients;

        $clients = Auth::user()->clients()
            ->with('numberOfBills')
            ->where(function ($query) use ($searchQuery) {
                $query->where('name', 'like', $searchQuery.'%')
                    ->orWhere('email', 'like', $searchQuery.'%')
                    ->orWhere('phone_number', 'like', $searchQuery.'%');
            })->orderBy('created_at', 'desc')
            ->paginate($perPage);

        $clients->appends(['search-query' => $searchQuery]);

        return $clients;
    }

    /**
     * Add new client.
     *
     * @param Request $request
     */
    public function addClient(Request $request) {
        $this->validateAddClientData($request);

        Auth::user()->clients()->save(new Client([
            'name' => $request->get('client_name'),
            'phone_number' => $request->get('phone_number'),
            'email' => $request->get('client_email'),
            'wish_happy_birth_day' => $request->get('wish_happy_birth_day'),
        ]));

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
    public function deleteClient($clientId, ClientJsonResponses $clientJsonResponses) {

        $user = Auth::user();
        $client = $user->clients()->where('id', $clientId)->first();

        // Make sure user has the authorization to delete the client
        if (!$client) {
            return $clientJsonResponses->doesNotBelongsToCurrentUser();
        }

        $user->clients()->where('id', $clientId)->delete();

        return response()->json([
            'title' => 'Succes!',
            'message' => 'Clientul a fost șters, împreună cu toate facturile sale.',
        ]);

    }

    /**
     * Update client name.
     *
     * @param  int $clientId
     * @param  Request $request
     * @param  ClientJsonResponses $clientJsonResponses
     * @return ClientJsonResponses
     */
    public function updateName($clientId, Request $request, ClientJsonResponses $clientJsonResponses) {

        $user = Auth::user();
        $client = $user->clients()->where('id', $clientId)->first();

        // Make sure user has the authorization to update the name of this ClientPage
        if (!$client) {
            return $clientJsonResponses->doesNotBelongsToCurrentUser();
        }

        $user->clients()->where('id', $clientId)->update([
            'name' => $request->get('name')
        ]);

        return $clientJsonResponses->nameUpdated($request->get('name'));
    }

    public function getBasicInformations($clientId, ClientJsonResponses $clientJsonResponses) {
        $client = Auth::user()->clients()->where('id', $clientId)->first();

        // Make sure client belongs to the current user
        if ( ! $client) {
            return $clientJsonResponses->doesNotBelongsToCurrentUser();
        }

        return $clientJsonResponses->basicInformations($client);
    }

    /**
     * Get personal informations.
     *
     * @param  int $clientId
     * @param  ClientJsonResponses $clientJsonResponses
     * @return ClientJsonResponses
     */
    public function getPersonalInformations($clientId, ClientJsonResponses $clientJsonResponses) {

        $client = Auth::user()->clients()->where('id', $clientId)->first();

        // Make sure client belongs to the current user
        if ( ! $client) {
            return $clientJsonResponses->doesNotBelongsToCurrentUser();
        }

        return $clientJsonResponses->personalInformations($client);
    }

    /**
     * Validate data used to add a new client.
     *
     * @param Request $request
     */
    protected function validateAddClientData($request) {
        $this->validate($request, [
            'client_name' => ['required', 'string', 'between:3,100'],
            'client_phone_number' => ['string', 'size:10', 'not_belongs_to_another_client_of_same_user:phone_number'],
            'client_email' => ['email', 'not_belongs_to_another_client_of_same_user:email'],
            'wish_happy_birth_day' => ['boolean'],
            'birth_day' => ['required_with:wish_happy_birth_day', 'date_format:d-m-Y']
        ]);
    }

    protected function getClientsOrderMethod() {

        $order = Auth::user()->settings()->first()->order_clients_by;

        if ($order === 'created_at_desc') {
            return [
                'column' => 'created_at',
                'type' => 'desc'
            ];
        }

    }

}
