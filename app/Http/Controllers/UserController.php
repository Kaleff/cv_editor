<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
    public function loginShow(): View {
        return view('login');
    }

    /**
     * Proccess the login request
     */
    public function login(Request $request): RedirectResponse {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        if(Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return to_route('homepage');
        }

        return back()->withErrors([
            'email' => 'Email or password were not correct.',
        ])->onlyInput('email');
    }

    public function registerShow(): View {
        return view('register');
    }

    /**
     * Proccess the register request
     */
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
        return to_route('homepage');
    }

    public function logout(Request $request): RedirectResponse {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return to_route('homepage');
    }
}
