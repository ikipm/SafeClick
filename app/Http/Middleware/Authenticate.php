<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function handle($request, Closure $next, ...$guards)
    {
        $this->authenticate($request, $guards);
        if ($request->session()->get('user_ip_address') !== $request->ip()) {
            auth()->logout();
            $request->session()->forget('user_ip_address');
            return redirect('login');
        }
        return $next($request);
    }

    protected function redirectTo($request)
    {
        if (!$request->expectsJson()) {
            redirect("/login");
        }
    }
}
