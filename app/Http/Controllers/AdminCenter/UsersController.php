<?php

namespace App\Http\Controllers\AdminCenter;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use App\User;
use Auth;

/**
 * Handle users administration.
 *
 * @author Alexandru Bugarin <alexandru.bugarin@gmail.com>
 */
class UsersController extends BaseController {

    /**
     * @var array
     */
    protected $validatedFields = ['new_password', 'new_password_confirmation'];

    /**
     * Render users page.
     */
    public function index() {
        return view('pages.admin-center.users');
    }

    /**
     * Handle search of users.
     * @param  Request $request
     */
    public function search(Request $request) {
        return User::where('email', 'like', $request->get('search_query').'%')->paginate();
    }

    /**
     * Render user details page.
     * @param  int $userId
     */
    public function user($userId) {
        return view('pages.admin-center.user')->with('userId', $userId);
    }

    /**
     * Get user data.
     * @param  int $userId
     */
    public function getUser($userId) {
        return User::where('id', $userId)->first();
    }

    /**
     * Allow admin to disable user accounts.
     *
     * @param  int $userId
     */
    public function disableAccount($userId) {

        if (Auth::user()->id == $userId) {
            return response()->json([
                'title' => 'Ooops.',
                'message' => 'Nu îți poți dezactiva contul tău.',
            ], 422);
        }

        User::where('id', $userId)->update([
            'disabled' => true
        ]);

        return response()->json([
            'title' => 'Succes!',
            'message' => 'Contul a fost dezactivat!'
        ]);
    }

    /**
     * Allow admin to enable user accounts.
     *
     * @param  int $userId
     */
    public function enableAccount($userId) {
        User::where('id', $userId)->update([
            'disabled' => false
        ]);

        return response()->json([
            'title' => 'Succes!',
            'message' => 'Contul a fost activat!'
        ]);
    }

    /**
     * Allow admin to delete accounts.
     *
     * @param  int $userId
     */
    public function deleteAccount($userId) {
        if (Auth::user()->id == $userId) {
            return response()->json([
                'title' => 'Oooops.',
                'message' => 'Nu îți poți șterge contul tău.',
            ], 422);
        }

        User::where('id', $userId)->delete();

        return response()->json([
            'title' => 'Succes!',
            'message' => 'Contul a fost șters.'
        ]);
    }

    /**
     * Allow admin to change account password.
     *
     * @param  int  $userId
     * @param  Request $request
     */
    public function changePassword($userId, Request $request) {
        dsadsa();
        $this->validateChangePasswordData($request);

        // Make sure user don't change password of current account
        if (Auth::user()->id == $userId) {
            return response()->json([
                'title' => 'Ooops.',
                'message' => 'Nu poți schimba parola acestui cont. Folosește secțiunea dedicată.'
            ], 422);
        }

        User::where('id', $userId)->update([
            'password' => bcrypt($request->get('new_password'))
        ]);

        return response()->json([
            'title' => 'Succes!',
            'message' => 'Parola contului a fost schimbată.'
        ]);
    }

    /**
     * Validate the data used to change user password.
     *
     * @param  Request $request
     */
    protected function validateChangePasswordData($request) {
        $this->validate($request, [
            'new_password' => ['required', 'string', 'between:6,50', 'confirmed'],
            'new_password_confirmation' => ['required', 'string', 'between:6,50']
        ]);
    }
}
