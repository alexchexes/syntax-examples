<?php
declare(strict_types=1);

namespace Foo;

abstract class Bar {}
interface Baz {}

final class Foo extends Bar Implements Baz
{
    /** 
     * @var asd $asde
     * @param int $foo Description 
     * @return Foo\Bar Description that mentions `foo` (or $foo) parameter
     * @param callable(Foo\Bar):int
     */
    private function __construct(
        private ?int $foo = null,
    )
    {
        $this->foo = (int) $foo;        
        echo static::class;
        throw new \Exception('Not implemented');
    }
}
