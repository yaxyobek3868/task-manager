<?php

namespace App\Services\Auth;


use App\Services\Auth\Contract\AuthContract;
use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class AuthService implements AuthContract
{
    public function login(array $data): array
    {
        try {
            $username = $data["username"];

            $field = filter_var($username, FILTER_VALIDATE_EMAIL)
                ? 'email'
                : 'username';

            $credentials = [
                $field => $username,
                'password' => $data['password']
            ];

            if (!Auth::attempt($credentials)) {
                return [
                    'status' => false,
                    'message' => 'Login yoki parol noto‘g‘ri'
                ];
            }

            return [
                'status' => true,
                'message' => 'Muvaffaqiyatli login qilindi'
            ];

        } catch (\Throwable $th) {
            return [
                'status' => false,
                'message' => $th->getMessage()
            ];
        }
    }

    public function loginByEmail(array $data): JsonResponse
    {
        try {
            if (!Auth::attempt($data)) {
                return response()->json([
                    'status' => false,
                    'message' => 'Login yoki parol noto‘g‘ri'
                ], 401);
            }

            return response()->json([
                'status' => true,
                'message' => 'Muvaffaqiyatli login qilindi'
            ]);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ]);
        }
    }

    public function logout(Request $request): void
    {
        try {

            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

        } catch (Exception $e) {
            throw new Exception("Logout jarayonida xatolik yuz berdi");
        }
    }

    public function register(array $data): JsonResponse
    {
        try {

            return User::create([
                'name' => $data['name'],
                'username' => $data['username'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
            ]);

        } catch (Exception $e) {
            throw new Exception("Ro‘yxatdan o‘tishda xatolik yuz berdi");
        }
    }
}

