<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LocaleController extends Controller
{
    public function changeLocale(Request $request, $lang)
    {
        // Locales permitted
        $locales = ['cat', 'es', 'en'];

        // Validate the lang parameter
        if (!in_array($lang, $locales)) {
            abort(404);
        }

        // Set the locale
        app()->setLocale($lang);
        session(['locale' => $lang]);

        // If it comes from outside the website or not in the same domain, redirect to /
        if (!$request->headers->has('referer') || !str_contains($request->headers->get('referer'), request()->getSchemeAndHttpHost())) {
            return redirect("/");
        } else {
            return redirect()->back();
        }
    }
}
