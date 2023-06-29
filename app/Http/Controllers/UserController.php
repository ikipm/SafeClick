<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Register a new user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function register(Request $request)
    {
        // Validate user input
        $validatedData = $request->validate([
            'name' => 'required',
            'userName' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
        ], [
            'userName.unique' => 'This username is already in use.',
            'email.unique' => 'This email is already in use.',
        ]);

        // Create a new user
        $user = User::create([
            'name' => $validatedData['name'],
            'userName' => $validatedData['userName'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
        ]);

        // Log in the user
        Auth::login($user);

        // Getting the locale used
        $loginUrl = $request->headers->get('referer');
        $locale = explode('/', parse_url($loginUrl, PHP_URL_PATH))[1];

        // Redirect to the /{locale}/courses
        return redirect("/$locale/courses");
    }

    /**
     * Log in the user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {
        // Validate user input
        $validatedData = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Attempt to authenticate the user
        $credentials = $request->only($validatedData['email'], $validatedData['password']);

        if (Auth::attempt($credentials)) {
            // If authentication successful, regenerate the session
            $request->session()->regenerate();

            // Get the locale from the URL
            $locale = $request->segment(1);

            // Redirect the user to the courses page
            return redirect("/$locale/courses");
        } else {
            // If authentication failed, redirect back to login with an error message
            // Getting the locale used
            $loginUrl = $request->headers->get('referer');
            $locale = explode('/', parse_url($loginUrl, PHP_URL_PATH))[1];
            return redirect("/$locale/login")->withErrors(["errorLogin" => "The email or password may be wrong. Please try again."]);
        }
    }

    /**
     * Log out the user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        // Log out the user
        Auth::logout();

        // Getting the locale used
        $lastUrl = $request->headers->get('referer');
        $locale = explode('/', parse_url($lastUrl, PHP_URL_PATH))[1];

        // Redirect the user to the login page
        return redirect("/$locale/login");
    }
}
