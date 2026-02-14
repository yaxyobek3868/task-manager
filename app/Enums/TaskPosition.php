<?php

namespace App\Enums;

enum TaskPosition: int
{
    case All = 1;
    case Created = 2;
    case Changed = 3;
    case AssignEmployee = 4;
    case RemovedEmployee = 5;
    case TaskUpdated = 6;
    case EdnDateUpdated = 7;



    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

}
