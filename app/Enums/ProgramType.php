<?php
// app/Enums/ProgramType.php
namespace App\Enums;

enum ProgramType: string
{
    case Movie = 'movie';
    case Series = 'series';

    public static function values(): array
    {
        //funcion static = no invocada, solo se llama
        return array_map(fn(self $c) => $c->value, self::cases());
    }

    public static function fromValue(string $value): ?self
    {
        foreach (self::cases() as $case) {
            if ($case->value === $value) return $case;
        }
        return null;
    }
}
