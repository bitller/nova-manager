<?php

namespace App\Http\Controllers\Dashboard\Settings;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Auth;
use App\ApplicationSetting;
use App\User;

/**
 * Allow user to manage subscriptions.
 *
 * @author Alexandru Bugarin <alexandru.bugarin@gmail.com>
 */
class SubscriptionDetailsController extends BaseController {

    /**
     * Logged in user.
     *
     * @var Object
     */
    protected $user = null;

    /**
     * Controller constructor.
     */
    public function __construct() {
        parent::__construct();
        $this->user = Auth::user();
    }

    /**
     * Render subscription details page.
     */
    public function index() {
        return view('pages.dashboard.settings.subscription-details');
    }

    /**
     * Generate client token used to tokenize payment form.
     *
     * @return Response
     */
    public function generateClientToken() {
        return response()->json([
            'client_token' => \Braintree_ClientToken::generate()
        ]);
    }

    /**
     * Return current subscription details.
     *
     * @return Response
     */
    public function currentSubscription() {

        $response = [
            'subscribed' => $this->user->subscribed('main'),
            'on_trial' => $this->user->onGenericTrial(),
        ];

        if ($response['on_trial']) {
            $response['trial_days'] = ApplicationSetting::first()->trial_days;
        }

        // Return more info if user has a paid subscription
        if ($this->user->subscription('main')) {
            $response['cancelled'] = $this->user->subscription('main')->cancelled();
            $response['on_grace_period'] = $this->user->subscription('main')->onGracePeriod();
        }

        return response()->json($response);
    }

    public function createNewSubscription(Request $request) {
        Auth::user()->newSubscription('main', 'monthly')->create($request->get('nonce'));
    }

    /**
     * Cancel user subscription.
     *
     * @return Response
     */
    public function cancelSubscription() {

        // Make sure user has an active subscription
        if ( ! $this->user->subscribed('main')) {
            return response()->json([
                'message' => 'Nu aveți un abonament activ.'
            ], 422);
        }

        $this->user->subscription('main')->cancel();

        return response()->json([
            'message' => 'Abonamentul a fost anulat.'
        ]);
    }

    /**
     * Allow user to resume their subscription (if is in grace period).
     *
     * @return Response
     */
    public function resumeSubscription() {

        // User can resume a subscription only if is in grace period
        if (!$this->user->subscription('main')->onGracePeriod()) {
            return response()->json([
                'message' => 'Abonamentul nu poate fi reactivat. Creați unul nou.'
            ], 422);
        }

        $this->user->subscription('main')->resume();

        return response()->json([
            'message' => 'Abonamentul a fost reactivat.'
        ]);
    }
}
