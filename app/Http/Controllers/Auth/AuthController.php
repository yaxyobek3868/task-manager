<?php

namespace App\Http\Controllers\Auth;

use App\Enums\UserRole;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(LoginRequest $request)
    {
        if (Auth::attempt($request->validated())) {
            $request->session()->regenerate();
            return redirect()->intended("users");
        }

        return back()->withErrors(['login' => 'Login yoki parol xato'])
        ->withInput($request->only('password', 'username'));
    }

    public function showLoginByEmail()
    {
        return view('auth.login_by_email');
    }

    public function loginByEmail(LoginRequest $request)
    {
        if (Auth::attempt($request->validated())) {
            $request->session()->regenerate();
            return redirect()->intended("users");
        }

        return back()->withErrors(['login' => 'Login yoki parol xato'])
            ->withInput($request->only('password', 'username'));
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    public function showRegister()
    {
        return view('auth.register');
    }


    public function register(RegisterRequest $request)
    {
        $data = $request->validated();

        $user = User::create([
            'name' => $data['name'],
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => UserRole::Student,
        ]);


        Auth::login($user);

        return redirect()->route('users.index')
            ->with('success', 'Xush kelibsiz! Ro\'yxatdan o\'tish muvaffaqiyatli.');
    }
}

