<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends controller
{
    public function register(Request $request)
    {
        // Validate data
        $validatedData = $request->validate([
            'name' => 'required',
            'userName' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
        ], [
            'userName.unique' => 'This username is already in use.',
            'email.unique' => 'This email is already in use.',
        ]);

        // Create the user
        $user = new User();
        $user->name = $validatedData['name'];
        $user->userName = $validatedData['userName'];
        $user->email = $validatedData['email'];
        $user->password = Hash::make($validatedData['password']);

        $user->save();

        Auth::login($user);

        $loginUrl = $request->headers->get('referer');
        $locale = explode('/', parse_url($loginUrl, PHP_URL_PATH))[1];

        // Redirect to courses page with the correct locale
        return redirect("/$locale/courses");
    }

    public function login(Request $request)
    {
        //
    }

    public function logout(Request $request)
    {
        //
    }
}
