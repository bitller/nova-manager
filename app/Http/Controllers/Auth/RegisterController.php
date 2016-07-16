<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\BaseController;
use App\Role;
use App\User;
use App\Setting;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Request;

/**
 * Handle user registration.
 *
 * @author Alexandru Bugarin <alexandru.bugarin@gmail.com>
 */
class RegisterController extends BaseController {

    /**
     * @var string
     */
    public $redirectTo = '/dashboard';

    /**
     * @var array
     */
    protected $validatedFields = ['email', 'password', 'password_confirmation'];

    /**
     * Render register page.
     *
     * @return mixed
     */
    public function index() {
        return view('pages.auth.register');
    }

    /**
     * Register new user.
     *
     * @param Request $request
     * @return mixed
     * @throws \Exception
     */
    public function register(Request $request) {

        $this->validateRegisterData($request);

        // Insert user
        $user = User::create([
            'email' => $request->get('email'),
            'password' => bcrypt($request->get('password')),
            'trial_ends_at' => Carbon::now()->addMinutes(10),
        ]);

        // Save user settings
        $user->settings()->save(new Setting([
            'number_of_bills' => 10,
            'number_of_clients' => 10
        ]));

        // Attach role
        $role = Role::where('name', 'admin')->first();
        $user->attachRole($role);

        Auth::login($user);

        // Return json response
        return response()->json([
            'title' => trans('common.success'),
            'message' => trans('auth.register.user_created'),
            'redirect_to' => $this->redirectTo
        ]);
    }

    /**
     * Validate data used to create a new user.
     *
     * @param $request
     */
    protected function validateRegisterData($request) {
        $this->validate($request, [
            'email' => ['required', 'email', 'not_exists:users,email'],
            'password' => ['required', 'string', 'between:6,128', 'confirmed'],
            'password_confirmation' => ['required']
        ]);
    }

}
