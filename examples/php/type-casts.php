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

// Old PHP 5-era style code from a legacy admin panel.

$row = [
    'user_id'      => '42',
    'is_admin'     => '1',
    'balance'      => '99.95',
    'nickname'     => null,
    'last_login'   => 1700000000,
    'permissions'  => 'manage_users',
    'meta'         => null,
];

// Old alias casts commonly seen in legacy code
$userId    = (integer) $row['user_id'];
$isAdmin   = (boolean) $row['is_admin'];
$balance   = (double) $row['balance'];

// Regular casts that were also common
$nickname  = (string) $row['nickname'];
$lastLogin = (string) $row['last_login'];
$meta      = (array) $row['meta'];
$perms     = (array) $row['permissions'];


if ($isAdmin) {
    echo "Admin #".$userId." (".$nickname.") has balance ".$balance."\n";
    echo "Last login: ".$lastLogin."\n";
}
