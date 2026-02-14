<?php

namespace App\Enums;

enum TaskStatus: int
{
    case Pending = 1;
    case InProgress = 2;
    case Done = 3;


    public function isPending(): bool
    {
        return self::Pending == $this;
    }

    public function isInProgress(): bool
    {
        return self::InProgress == $this;
    }

    public function isDone(): bool
    {
        return self::Done == $this;
    }


    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

}
