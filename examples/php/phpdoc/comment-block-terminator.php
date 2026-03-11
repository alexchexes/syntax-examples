<?php
declare(strict_types=1);

/**
 * This allows escaping the literal PHP block comment terminator, which cannot be  written directly inside PHPDoc (`* /` without space).
 * It works in newer versions of PHPStan, and possibly in other tools.
 * @param "\u{2a}\u{2f}" $s
 * @param "*\u{2f}" $s
 * @param "\u{2a}/" $s
 * @param "\x2a/" $s
 * @param "*\x2f" $s
 * 
 * And these are not escaped as they are in single quotes:
 * 
 * @param '\u{2a}\u{2f}' $s
 * @param '*\u{2f}' $s
 * @param '\u{2a}/' $s
 * @param '\x2a/' $s
 * @param '*\x2f' $s
 */

// POC:
/** @param "*\x2f" $s */
function takesOnlyCommentClose(string $s): void
{
}
takesOnlyCommentClose('*/');  // OK
takesOnlyCommentClose('*\/'); // PHPStan error
takesOnlyCommentClose('x');   // PHPStan error

// vendor/bin/phpstan analyse examples/php/phpdoc/literal-comment-block-end.php --level=max