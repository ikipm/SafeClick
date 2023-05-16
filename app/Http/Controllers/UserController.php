<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Hash; // To encrypt the keys
use Session; // Store user data in the request
use App\Models\User; // User model
use Illuminate\Support\Facades\Auth; // Laravel authentication


class UserController extends controller
{
    function index()
    {
        return view('login');
    }
}
