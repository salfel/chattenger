<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
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
        if(Auth::attempt($request->validated(), true)) {
            Session::regenerate();

            return to_route('chats.index');
        }

        return back()->withErrors(['email' => 'Wrong email or password']);
    }

    public function register()
    {
        return Inertia::render('Auth/Register');
    }
}
