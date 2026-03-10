<?php
declare(strict_types=1);

$CURRENT_USER_ID = 42;

trait ReadsLog
{
    public function log(string $message): void {}
}

trait WritesLog
{
    public function log(string $message): void {}
}

/**
 * @access public
 * @access private
 * @access protected
 * @access package
 */
enum VisibilityDemo: string
{
    case PUBLIC = 'public';
    case PRIVATE = 'private';
    case PROTECTED = 'PROTECTED';
    public const ALIAS1 = self::PUBLIC;
    public const ALIAS2 = self::PRIVATE;
}

abstract class AbstractRecord
{
    abstract protected static function bar(): string;

    public function __construct(
        public(set) readonly string $name,
        private(set) int $age,
        protected string $email,
    ) {}
}

readonly class ReadonlySnapshot
{
    public function __construct(public string $id) {}
}

final class UserRecord extends AbstractRecord
{
    use ReadsLog, WritesLog {
        ReadsLog::log insteadof WritesLog;
        WritesLog::log as private;
        ReadsLog::log as protected trace;
        ReadsLog::log as final audit;
        ReadsLog::log as renamedLog;
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
        $this->id = 'user-' . self::$hits++;
    }

    final public static function fromGlobal(): static
    {
        global $CURRENT_USER_ID;

        return new self('Alex', 30, 'alex@example.com', 'admin');
    }

    protected static function bar(): string
    {
        return 'user:' . self::$hits;
    }

    public function demoSwitch(VisibilityDemo $visibility): void
    {
        switch ($visibility) {
            case VisibilityDemo::PUBLIC:
                break;
            default:
                break;
        }
    }
}

$anonymous = new readonly class {
    public function ping(): void {}
};
