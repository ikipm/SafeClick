<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Register a new user.
     *
     * @Pre: $request is passed as a parameter.
     * @Post: A new user is registered and the client logged in.
     */
    public function register(Request $request)
    {
        $this->setLocale();

        $validatedData = $this->validateUser($request);

        $user = $this->createUser($validatedData);

        event(new Registered($user));

        $this->loginUser($request, $user);

        return redirect("/courses");
    }

    /**
     * Register a new user without login in it.
     *
     * @Pre: $request is passed as a parameter.
     * @Post: A new admin user is registered.
     */
    public function adminRegister(Request $request)
    {
        $this->setLocale();

        $validatedData = $this->validateUser($request);

        $this->createUser($validatedData, $request->boolean('admin'), $request->boolean('testUser'));

        return redirect("/admin/users");
    }

    /**
     * Search for users give a querry.
     *
     * @Pre: $request is passed as a parameter.
     * @Post: The users that match the search criteria are returned.
     */
    public function adminSearch(Request $request)
    {
        $query = User::query();

        if ($request->filled('name')) {
            $query->where('name', 'like', "%{$request->input('name')}%");
        }

        if ($request->filled('userName')) {
            $query->where('userName', 'like', "%{$request->input('userName')}%");
        }

        if ($request->filled('email')) {
            $query->where('email', 'like', "%{$request->input('email')}%");
        }

        $users = $query->get();
        return redirect('/admin/users')->with('users', $users);
    }

    /**
     * Log in the client.
     *
     * @Pre: $request is passed as a parameter.
     * @Post: The client is logged in.
     */
    public function login(Request $request)
    {
        $this->setLocale();

        $validatedData = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($validatedData)) {
            $this->loginUser($request, Auth::user());
            return redirect("/courses");
        } else {
            return redirect("/login")->withErrors(["errorLogin" => __('loginPage.errorLogin')]);
        }
    }

    /**
     * Log in the client with the test user.
     *
     * @Pre: $request is passed as a parameter.
     * @Post: The client is logged as the default test user.
     */
    public function loginTest(Request $request)
    {
        $credentials = [
            "email" => 'test@safeclick.cat',
            "password" => '>c6s0UFa0?|5]J#,AXu('
        ];

        if (Auth::attempt($credentials)) {
            $this->loginUser($request, Auth::user());

            Log::channel('guest')->info(sprintf('New user guest IP: %s', $request->ip()));

            return redirect("/courses");
        } else {
            return redirect('/login');
        }
    }

    /**
     * Log out the client.
     *
     * @Pre: $request is passed as a parameter.
     * @Post: The client is logged out.
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->forget('user_ip_address');

        return redirect("/login");
    }

    /**
     * Create a new user.
     * 
     * @Pre: $userData is passed as a parameter and admin and testUser are optional and set to false by default.
     * @Post: A new user is created with the given data.
     */
    private function createUser($userData, $admin = false, $testUser = false)
    {
        return User::create([
            'name' => $userData['name'],
            'userName' => $userData['userName'],
            'email' => $userData['email'],
            'password' => Hash::make($userData['password']),
            'admin' => $admin,
            'testUser' => $testUser
        ]);
    }

    /**
     * Set the locale of the website.
     * 
     * @Pre: None.
     * @Post: The locale of the website is set to the one stored in the session.
     */
    private function setLocale()
    {
        $locale = Session::get('locale', 'cat');
        app()->setLocale($locale);
    }

    /**
     * Validate the user data.
     * 
     * @Pre: $request is passed as a parameter.
     * @Post: The user data is validated.
     */
    private function validateUser(Request $request)
    {
        return $request->validate([
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
    }

    /**
     * Log in the client.
     * 
     * @Pre: $request and $user are passed as a parameter.
     * @Post: The client is logged in with the $user data.
     */
    private function loginUser(Request $request, $user)
    {
        Auth::login($user);
        $request->session()->regenerate();
        $request->session()->put('user_ip_address', $request->ip());
    }
}
