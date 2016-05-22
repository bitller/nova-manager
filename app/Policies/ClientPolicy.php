<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use App\User;
use App\Client;

/**
 * Client model policy.
 *
 * @author Alexandru Bugarin <alexandru.bugarin@gmail.com>
 */
class ClientPolicy {

    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct() {
        //
    }

    // public function show(User $user, Client $client) {
        // return $user->id
    // }

    /**
     * Determine if the given client can be deleted by the user.
     *
     * @param  User   $user
     * @param  Client $client
     */
    public function delete(User $user, Client $client) {
        return $user->id === $client->user_id;
    }
}
