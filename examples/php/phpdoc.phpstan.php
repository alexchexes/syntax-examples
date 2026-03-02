<?php declare(strict_types=1);

/**
 * @phpstan-type TypeFoo 'foo'
 *  |'bar'
 *  | array{
 *    'foo'
 *    | 'bar'
 *    | 'baz'
 *    | 1 | 2 | 3
 *    | '{' | '}' // ha-ha, got you!
 *    | BAZ
 *    | Foo\Bar::BAZ
 *    | array { foo: int, bar: 'a' | 'b' | BAZ }
 *    | int
 *  }
 *  |'baz'
 *  | 1 | 2 | 3
 *  | BAZ
 *  | Foo\Bar::BAZ
 *  |'qux' Is "|" a union operator? 
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
