<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Services\Auth\Contract\AuthContract;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function __construct(
        protected AuthContract $authContract
    ) {}

    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(LoginRequest $request)
    {
       $response = $this->authContract->login($request->validated());

       if ($response['status']) {
           return redirect()->route('user.index');
       }

       return redirect()->back()->withErrors($response['message']);
    }

    public function showLoginByEmail()
    {
        return view('auth.login_by_email');
    }

    public function loginByEmail(LoginRequest $request)
    {
       return $this->authContract->loginByEmail($request->validated());
    }

    public function logout(Request $request)
    {
        $this->authContract->logout($request);
        return redirect()->route('login');
    }

    public function showRegister()
    {
        return view('auth.register');
    }


    public function register(RegisterRequest $request)
    {
        $data = $request->validated();
        $this->authContract->register($data);

        return redirect()->route('users.index')
            ->with('success', 'Xush kelibsiz! Ro\'yxatdan o\'tish muvaffaqiyatli.');
    }
}

