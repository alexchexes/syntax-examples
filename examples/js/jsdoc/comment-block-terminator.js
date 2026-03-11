// @ts-check

/** 
 * @param {"*\/"} s
 * @param {"\u{2a}/"} s
 * @param {"*\u{2f}"} s
 */

// POC:

/** @param {"*\/"} s */
function foo1(s) {}

foo1('*/'); // OK
foo1('*\\/'); // error
foo1('x'); // error

/** @param {"\u{2a}/"} s */
function foo2(s) {}
foo2('*/'); // OK
foo2('*\\/'); // error
foo2('x'); // error

/** @param {"*\u{2f}"} s */
function foo3(s) {}
foo3('*/'); // OK
foo3('*\\/'); // error
foo3('x'); // error
