<?php

class A
{
    public static function a(
        mixed $a,
        false|true $b,
        int|float|string|bool|array|object|null $c
    ): static|self|int|bool|float|string|array|object|null
    {
        parent::class;
        static::class;
        self::class;

        (int) $a;
        (integer) $a;
        (bool) $a;
        (boolean) $a;
        (float) $a;
        (double) $a;
        (real) $a;
        (string) $a;
        (binary) $a;
        (array) $a;
        (object) $a;
        (unset) $a;
        return $a;
    }
}
