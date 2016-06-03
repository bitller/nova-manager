<?php

namespace App\Http\JsonResponses;

/**
 * Client json responses.
 *
 * @author Alexandru Bugarin <alexandru.bugarin@gmail.com>
 */
class ClientJsonResponses {

    /**
     * Response returned when the client does not belongs to the user.
     *
     * @return Response
     */
    public function doesNotBelongsToCurrentUser() {
        return response()->json([
            'title' => 'O eroare a avut loc.',
            'message' => 'Acest client nu vă aparține.',
        ], 422);
    }

    public function nameUpdated($newName) {
        return response()->json([
            'title' => 'Succes!',
            'message' => 'Numele clientului a fost actualizat.',
            'name' => $newName,
        ]);
    }

    /**
     * Response with client basic informations.
     *
     * @param  App\Client $client
     * @return Response
     */
    public function basicInformations($client) {
        return response()->json([
            'name' => $client->name,
            'created_at' => date('d-m-Y', $client->created_at->timestamp)
        ]);
    }

    /**
     * Response with client personal informations.
     *
     * @param  App\Client $client
     * @return Response
     */
    public function personalInformations($client) {
        return response()->json([
            'email' => $client->email,
            'phone_number' => $client->phone_number,
            'birth_day' => $client->birth_day,
        ]);
    }
}
