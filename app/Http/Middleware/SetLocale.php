<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // Check if the lang parameter is present in the URL
        if ($request->has('lang')) {
            $locale = $request->input('lang');
            app()->setLocale($locale);
            session(['locale' => $locale]);
        }
        else if ($request->is('locale/*')) {
            $locale = $request->segment(2);
            app()->setLocale($locale);
            session(['locale' => $locale]);
        }
        else {
            // If the lang parameter is not present, check if the locale is stored in the session
            $locale = session('locale');
            if ($locale) {
                app()->setLocale($locale);
            }
        }

        return $next($request);
    }
}
