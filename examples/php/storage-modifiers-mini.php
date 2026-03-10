<?php

trait SomeTraitA
{
    public function log(): void {}
}

trait SomeTraitB
{
    public function log(): void {}
}

abstract class AbstractMeta {}

abstract class AbstractBase extends AbstractMeta
{
    use SomeTraitA, SomeTraitB {
        SomeTraitB::log as private;
        SomeTraitB::log as private;
        SomeTraitA::log as protected;
        SomeTraitA::log as final;
        SomeTraitB::log as private myAlias1;
        SomeTraitB::log as private myAlias2;
        SomeTraitA::log as protected myAlias3;
        SomeTraitA::log as final myAlias4;
    }

    public private(set) readonly string $id;
    protected(set) ?string $nickname;
    private static int $hits = 0;

    public function __construct(
        public(set) readonly string $name,
        private(set) int $age,
        protected string $email,
        public readonly string $role,
    ) {
        parent::__construct($name, $age, $email);
    }

    public static function foo(): static
    {
        return self::bar();
    }

    final public static function bar(): static
    {
        return new self('foo', 123, '', '');
    }

    protected static function quux(): string
    {
        return self::$hits;
    }

    abstract public function baz(): static;

    abstract protected static function qux(): string;
}

