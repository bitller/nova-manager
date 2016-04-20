<?php

namespace App\Http\Controllers\Dashboard\Settings;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Auth;

/**
 * Allow user to manage settings regarded to account security.
 *
 * @author Alexandru Bugarin <alexandru.bugarin@gmail.com>
 */
class SecurityController extends BaseController {

    /**
     * Validated fields.
     *
     * @var array
     */
    protected $validatedFields = ['current_password', 'new_password', 'new_password_confirmation'];

    /**
     * Render security settings page.
     */
    public function index() {
        return view('pages.dashboard.settings.security');
    }

    /**
     * Allow users to change account password.
     *
     * @param  Request $request
     */
    public function updateAccountPassword(Request $request) {
        $this->validateDataUsedToUpdateAccountPassword($request);

        Auth::user()->update([
            'password' => bcrypt($request->get('new_password'))
        ]);

        return response()->json([
            'title' => 'Succes!',
            'message' => 'Parola contului a fost actualizata!'
        ]);
    }

    /**
     * Validate data used to update user account password.
     *
     * @param  Illuminate\Http\Request $request
     */
    protected function validateDataUsedToUpdateAccountPassword($request) {
        $this->validate($request, [
            'current_password' => ['required', 'current_user_password'],
            'new_password' => ['required', 'string', 'between:6,100', 'confirmed'],
            'new_password_confirmation' => ['required', 'string', 'between:6,100']
        ]);
    }
}
