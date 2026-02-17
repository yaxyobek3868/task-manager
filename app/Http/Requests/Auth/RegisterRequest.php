<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class RegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'username' => [
                'required',
                'string',
                'max:255',
                'unique:users,username',
            ],
            'name' => ['required', 'string', 'max:255'],

            'email' => [
                'required',
                'email',
                'max:255',
                'unique:users,email',
            ],

            'password' => [
                'required',
                'confirmed',
                Password::min(3),
            ],


        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Ism kiritish majburiy.',
            'email.required' => 'Email kiritish majburiy.',
            'email.email' => 'Email formati noto‘g‘ri.',
            'email.unique' => 'Bu email allaqachon ro‘yxatdan o‘tgan.',
            'password.required' => 'Parol kiritish majburiy.',
            'password.confirmed' => 'Parollar mos kelmadi.',
            'username.required' => 'Foydalanuvchi nomi maydoni talab qilinadi.',
        ];
    }
}
