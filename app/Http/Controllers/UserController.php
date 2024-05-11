<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
    public function loginShow() {
        return view('login');
    }

    public function login(Request $request): RedirectResponse {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        if(Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('homepage');
        }

        return back()->withErrors([
            'email' => 'Email or password were not correct.',
        ])->onlyInput('email');
    }

    public function registerShow() {
        return view('register');
    }

    public function register(Request $request): RedirectResponse {
        $validatedData = $request->validate([
            'email' => ['required', 'unique:users', 'max:255'],
            'password' => ['required', 'min:4', 'confirmed'],
            'name' => ['required', 'min:3']
        ]);
        // Hash password
        $validatedData['password'] = bcrypt($validatedData['password']);
        $user = User::create($validatedData);
        auth()->login($user);
        return redirect()->intended('homepage');
    }
}
