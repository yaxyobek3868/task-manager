<?php

namespace App\Enums;

enum TaskPriority: int
{
    case Low = 1;
    case Medium = 2;
    case High = 3;


    public function isLow(): bool
    {
        return self::Low == $this;
    }

    public function isMedium(): bool
    {
        return self::Medium == $this;
    }

    public function isHigh(): bool
    {
        return self::High == $this;
    }


    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

}
