<?php

namespace App\Http\Controllers;

use App\Models\User;
use Dotenv\Validator;
use Faker\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use PHPUnit\TextUI\Application;
//use Illuminate\Support\Facades\Validator;


class UserController extends Controller
{
    public function register(): View|Factory|Application
    {
        return \view('auth.register');
    }

    public function login(): View|Factory|Application
    {
        return \view('auth.login');
    }

    public function store(Request $request): RedirectResponse
    {
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->route('register')->withErrors($validator);
        }

        $user = User::query()->create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);

        Auth::login($user);

        return redirect()->route('dashboard');
    }

    public function authenticate(Request $request): RedirectResponse
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('dashboard');
        }

        return redirect()->route('login')->withErrors([]);
    }

    public function error(): View|Factory|Application
    {
        return view('error');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    public function show(): View|Factory|Application
    {
        $user = Auth::user();
        return view('users.show', compact('user'));
    }
}
