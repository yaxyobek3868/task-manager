<?php

namespace App\Enums;

enum UserStatus: int
{
    case Pending = 1;
    case Active = 2;
    case InActive = 3;


    public function isPending(): bool
    {
        return self::Pending === $this;
    }

    public function isActive(): bool
    {
        return self::Active === $this;
    }

    public function isInActive(): bool
    {
        return self::InActive === $this;
    }


    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
