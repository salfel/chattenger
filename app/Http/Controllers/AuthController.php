<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Inertia\Inertia;

class AuthController extends Controller
{
    public function login()
    {
        return Inertia::render('Auth/Login');
    }

    public function authenticate(LoginRequest $request)
    {
        Auth::logout();
        if(Auth::attempt($request->validated())) {
            Session::regenerate();

            return to_route('home');
        }

        return back()->withErrors(['email' => 'Wrong email or password']);
    }

    public function register()
    {
        return Inertia::render('Auth/Register');
    }
}