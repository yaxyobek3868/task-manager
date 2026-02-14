<?php

namespace App\Enums;

enum UserRole: int
{
    case Admin = 1;
    case Manager = 2;
    case Student = 3;


    public function isAdmin(): bool
    {
        return self::Admin == $this;
    }

    public function isTeacher(): bool
    {
        return self::Manager == $this;
    }

    public function isStudent(): bool
    {
        return self::Student == $this;
    }


    public static function lists(): array
    {
        return [
            self::Admin,
            self::Manager,
            self::Student,
        ];
    }


    public static function person(): array
    {
        return [
            "student" => self::Student,
            "teacher" => self::Manager,
        ];
    }
}
