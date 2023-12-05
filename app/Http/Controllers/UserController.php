<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

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
        // Get the current locale from the session
        $locale = Session::get('locale', 'cat');

        // Set the locale for the logged-in user
        app()->setLocale($locale);

        // Validate user input
        $validatedData = $request->validate([
            'name' => 'required',
            'userName' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'privacy' => 'accepted',
            'terms' => 'accepted'
        ], [
            'userName.unique' => __('loginPage.errorUser'),
            'email.unique' => __('loginPage.errorEmail'),
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

        return redirect("/courses");
    }

    public function adminRegister(Request $request)
    {
        // Get the current locale from the session
        $locale = Session::get('locale', 'cat');

        // Set the locale for the logged-in user
        app()->setLocale($locale);

        // Check if the "admin" key exists and set a default value if it doesn't
        $admin = $request->admin;
        if ($admin == "on") {
            $admin = true;
        } else {
            $admin = false;
        }

        // Validate user input
        $validatedData = $request->validate([
            'name' => 'required',
            'userName' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
        ], [
            'userName.unique' => __('loginPage.errorUser'),
            'email.unique' => __('loginPage.errorEmail'),
        ]);

        // Create a new user
        $user = User::create([
            'name' => $validatedData['name'],
            'userName' => $validatedData['userName'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'admin' => $admin
        ]);

        return redirect("/admin/users");
    }

    public function adminSearch(Request $request)
    {
        $query = User::query();

        if ($request->filled('name')) {
            $name = $request->input('name');
            $query->where('name', 'like', "%$name%");
        }

        if ($request->filled('userName')) {
            $userName = $request->input('userName');
            $query->where('userName', 'like', "%$userName%");
        }

        if ($request->filled('email')) {
            $email = $request->input('email');
            $query->where('email', 'like', "%$email%");
        }

        $users = $query->get();
        return redirect('/admin/users')->with('users', $users);
    }

    /**
     * Log in the user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {
        // Get the current locale from the session
        $locale = Session::get('locale', 'cat');

        // Set the locale for the logged-in user
        app()->setLocale($locale);

        // Validate user input
        $validatedData = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Attempt to authenticate the user
        $credentials = $credentials = [
            "email" => $validatedData["email"],
            "password" => $validatedData["password"]
        ];

        if (Auth::attempt($credentials)) {
            // If authentication successful, regenerate the session
            $request->session()->regenerate();

            // Redirect the user to the courses page
            return redirect("/courses");
        } else {
            // If authentication failed, redirect back to login with an error message
            return redirect("/login")->withErrors(["errorLogin" => __('loginPage.errorLogin')]);
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

        // Redirect the user to the login page
        return redirect("/login");
    }
}
