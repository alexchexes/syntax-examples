<?php declare(strict_types=1);

namespace PHP;

/**
 * DTO class for
 * @see \Foo\Bar::fooBar()
 * @see \Foo\Bar::$fooBar
 * @see Foo\Bar::fooBar()
 * @see Foo\Bar::$fooBar
 * @see Bar::fooBar()
 * @see Bar::$fooBar
 * @see fooBar()
 * @see \fooBar()
 * 
 * @see parentMethod
 * @see parentMethod
 * 
 * Also see {@see \PHP\PhpDoc::foo()} and {@see PhpDoc::foo()}
 * or {@see \PHP\PhpDoc::FOO} with {@see PhpDoc::FOO}),
 * as well as {@see \PHP\PhpDoc::$bar} or {@see PhpDoc::$bar}
 * or even {@see \PHP\Bar} or {@see Bar}.
 * 
 * - also see this: {@see http://example.com}
 * - and {@see http://example.com this}
 * - and also {@link http://example.com this }
 * or see {@link Foo\Bar::fooBar()}
 * 
 * @phpstan-type pl_field 'id'
 *  |'search_id'
 *  |'ticket_id'
 * 
 * @phpstan-import-type SomeType from Foo\Bar
 */
class PhpDoc {
    const FOO = 123;
    private ?int $bar = null;
    private function foo($arg): void {}
    private function bar($arg): void {}
}
class Bar {}

/**
 * class 1
 * 
 * example of use of the :: scope operator
 * @see subclass::method()
 */
class main_class
{
    /**
     * example of linking to same class, outputs <u>main_class::parent_method()</u>
     * @see parent_method
     */
    private $foo = 3;
 
    /**
     * subclass inherits this method.
     * example of a word which is either a constant or class name, in this case a classname
     * @see subclass
     * @see subclass::$foo
     */
 
    function parent_method()
    {
        if ($this->foo==9) die;
    }
}
 
/**
 * this class extends main_class.
 * example of linking to a constant, and of putting more than one element on the same line
 * @see main_class, TEST_CONST
 */
class subclass extends main_class
{
    /**
     * example of same class lookup - see will look through parent hierarchy to
     * find the method in { @link main_class}
     * the above inline link tag will parse as <u>main_class</u>
     * @see parent_method()
     */
    var $foo = 9;
}
 
define("TEST_CONST","foobar");