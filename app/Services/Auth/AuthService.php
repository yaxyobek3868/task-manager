<?php

namespace App\Services\Auth;


use App\Enums\UserRole;
use App\Enums\UserStatus;
use App\Services\Auth\Contract\AuthContract;
use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
                'password' => $data['password'],
            ];


            $user = User::where($field, $username)->first();

            if (!$user) {
                return [
                    'status' => false,
                    'message' => 'Bunday foydalanuvchi mavjud emas'
                ];
            }

            if (!$user->status->isActive()) {
                return [
                    'status' => false,
                    'message' => 'Admin sizga ruhsat berishi kerak'
                ];
            }

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

    public function loginByEmail(array $data): array
    {
        try {
            if (!Auth::attempt($data)) {
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

    public function register(array $data): array
    {
        try {
            User::create([
                'name' => $data['name'],              // shu qatorda name bo‘lishi kerak
                'username' => $data['username'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'status' => UserStatus::Pending->value,
                'role' => UserRole::Employee->value,
            ]);




            return [
                'status' => true,
                'message' => 'Ro‘yxatdan o‘tish muvaffaqiyatli. Admin tasdiqlashi kutilmoqda.'
            ];

        }
//        catch (\Throwable $th) {
//
//            return [
//                'status' => false,
//                'message' => 'Ro‘yxatdan o‘tishda xatolik yuz berdi'
//            ];
//        }
        catch (\Throwable $th) {
            dd($th->getMessage(), $th->getFile(), $th->getLine());
        }

    }

}

