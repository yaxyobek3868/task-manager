<?php

namespace App\Services\Auth\Contract;


use Illuminate\Http\Request;

interface AuthContract
{
    public function login(array $data): array;
    public function loginByEmail(array $data): array;
    public function logout(Request $request): void;
    public function register(array $data): array;


}
