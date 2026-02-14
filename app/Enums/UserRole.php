<?php

namespace App\Enums;

enum UserRole: int
{
    case Admin = 1;
    case Manager = 2;
    case Employee = 3;
    case NoRole = 4;


    public function isAdmin(): bool
    {
        return self::Admin == $this;
    }

    public function isTeacher(): bool
    {
        return self::Manager == $this;
    }

    public function isEmployee(): bool
    {
        return self::Employee == $this;
    }

    public function isNoRole(): bool
    {
        return self::NoRole == $this;
    }


    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
