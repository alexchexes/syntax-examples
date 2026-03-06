<?php
declare(strict_types=1);

namespace Foo;

abstract class Bar {}
interface Baz {}

final class Foo extends Bar Implements Baz
{
    public const STATE_RUNNING = 'running';
    public const STATE_FINISHED = 'finished';

    /** 
     * @var asd $fgh
     * 
     * @param ?int $foo Description 
     * @return Foo\Bar Description that mentions `foo` (or $foo) parameter
     * @param self::STATE_* $state
     * @param callable(Foo\Bar):int
     */
    private function __construct(
        private ?int $foo,
        private string $state,
    )
    {
        $this->foo = (int) $foo;        
        echo static::class;
        throw new \Exception('Not implemented');
    }
}
