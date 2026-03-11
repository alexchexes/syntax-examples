<?php declare(strict_types=1);

/**
 * @phpstan-type TypeFoo 123 | 'foo'
 *  |'bar'
 *  | array<
 *    'foo'
 *    | 'bar'
 *    | 'baz'
 *    | 1 | 2 | 3
 *    | '{' | '}' // ha-ha, got you!
 *    | '@deprecated' | '{@see https://example.com}'
 *    | BAZ
 *    | baz
 *    | Foo\Bar::BAZ
 *    | array { foo: int, bar: 'a' | 'b' | BAZ | baz }
 *    | array {
 *      foo: int,
 *      bar: 'a' | 'b' | BAZ | baz
 *    }
 *    | int
 *  >
 *  |'baz'
 *  | 1 | 2 | 3
 *  | BAZ
 *  | baz
 *  | Foo\Bar::BAZ
 *  |'qux' Description of the TypeFoo where we say: Is | a union operator? 
 * 
 * @phpstan-import-type SomeType from Foo\Bar
 */
class PhpDoc{
    /**
     * @param TypeFoo | 'BAR' $arg
     */
    private function funcName($arg): void
    {
    }
}
