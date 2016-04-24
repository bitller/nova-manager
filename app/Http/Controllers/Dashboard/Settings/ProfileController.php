<?php

namespace App\Http\Controllers\Dashboard\Settings;

use App\Http\Controllers\BaseController;
use Auth;
use Illuminate\Http\Request;

/**
 * Allow user to edit his profile.
 *
 * @author Alexandru Bugarin <alexandru.bugarin@gmail.com>
 */
class ProfileController extends BaseController {

    /**
     * @var [type]
     */
    protected $validatedFields = ['email'];

    /**
     * Render profile settings page.
     */
    public function index() {
        return view('pages.dashboard.settings.profile');
    }

    /**
     * Return user email.
     */
    public function getEmail() {
        return response()->json([
            'email' => Auth::user()->email
        ]);
    }

    /**
     * Allow user to change their account email.
     *
     * @param  Request $request
     */
    public function changeEmail(Request $request) {
        $this->validateChangeEmailData($request);

        Auth::user()->update([
            'email' => $request->get('email')
        ]);

        return response()->json([
            'title' => 'Succes!',
            'message' => 'Adresa de email a fost actualizată!'
        ]);
    }

    /**
     * Validate data used to change email.
     *
     * @param  Request $request
     */
    protected function validateChangeEmailData($request) {
        $this->validate($request, [
            'email' => ['required', 'email', 'not_exists:users,email']
        ]);
    }
}
