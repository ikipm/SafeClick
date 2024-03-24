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

        // If it comes from outside the website, it redirects to /, if not, it redirects to the previous page
        if ($request->has('from')) {
            return redirect("/");
        } else {
            return redirect()->back();
        }
    }
}
