<?php

namespace TypeCasts;

use stdClass;

class A {}
class B extends A
{
    public static function a(
        mixed $a,
        false|true|stdClass $b,
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
        (string) $a;
        (binary) $a;
        (array) $a;
        (object) $a;

        $foo = static fn(int $a) => strlen((string) $a);

        (real) $a;
        (unset) $a;

        return [$a, $b, $c, $foo];
    }
}
