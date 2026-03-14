<?php
declare(strict_types=1);

namespace Foo;

abstract class Bar {}
interface Baz {}

final class Foo extends Bar Implements Baz
{
    public const STATE_RUNNING = 'running';
    public const STATE_FINISHED = 'finished';

    /** @var int Description $test is not `@var` name */
    public $baz;

    /**
     * Summary
     * 
     * Description with inline tag {@see Foo}
     * And one more @see Foo mentioned in text
     * 
     * More description
     * 
     * @var some $type
     * 
     * @param ?int $foo Description 
     * more description
     * 
     * @param int Description $baz is not a parameter name
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