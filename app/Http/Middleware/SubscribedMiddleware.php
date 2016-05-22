<?php

namespace App\Http\Middleware;

use Closure;

class SubscribedMiddleware {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {

        // Check if user is subscribed or is on trial
        if ($request->user() && ! $request->user()->subscribed('main') && ! $request->user()->onTrial()) {
        }
        return redirect('/dashboard/settings/subscription-details');

        return $next($request);
    }
}
