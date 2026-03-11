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
     * Summary
     * 
     * Description
     * 
     * @var asd $asd
     * 
     * @param ?int $foo Description 
     * more description
     * 
     * @param \Foo\Bar[] $foo Description 
     * @param \Foo\Bar[][] $foo Description 
     * @param (\Foo\Bar|Baz)[] $foo Description 
     * 
     * @param self::STATE_* $state
     * 
     * @param callable(\Foo\Bar):int
     * @param callable(\Foo\Bar[]):int
     * @param callable(\Foo\Bar[][]):int
     * @param (callable(\Foo\Bar[][]):int)[]
     * 
     * @return \Foo\Bar Description that mentions `foo` (or $foo) parameter
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

/** Docblock w/ description & tags w/o separation */
/*  Docblock w/ description & tags w/o separation */