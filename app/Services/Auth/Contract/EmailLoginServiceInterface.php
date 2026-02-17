<?php

namespace App\Services\Auth\Contract;

use App\Models\User;

interface EmailLoginServiceInterface
{
    public function sendCode(string $email): void;

    public function verifyCode(string $email, string $code): ?User;
}
