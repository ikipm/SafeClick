<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\MustVerifyEmail;

class VerifyEmailMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Check if the user is authenticated and email is not verified
        if ($request->user() && !$request->user()->hasVerifiedEmail()) {
            if ($request->user() instanceof MustVerifyEmail) {
                // Mark the email as verified
                $request->user()->markEmailAsVerified();
            }
            return redirect('/login?verify=yes');
        }

        return $next($request);
    }
}
