<?php

// Structured visual inventory for explicit PHP regex blocks.
// This file is for syntax-highlighting checks, not runtime validation.
// First pass: organized coverage for what we support now in explicit
// REGEX/REGEXP heredoc/nowdoc blocks, plus isolated known gaps.

$interpolatedName = 'name';
$interpolatedHex = 'A-F';

// ------------------------------------------------------------------
// Supported: basic atoms, anchors, alternation, and quantifiers
// ------------------------------------------------------------------

$re = <<<REGEX
^foo|bar$
\A.\b\B\G\Z\z
a* a+ a? a+? a?? a*?
\d{3,4}
\d{,4}?
\w{2,}
\p{L}{1,3}+
REGEX;

// ------------------------------------------------------------------
// Supported: explicit escapes outside character classes
// ------------------------------------------------------------------

$re = <<<REGEX
\d\D\w\W\s\S\h\H\v\V\R
\p{L}\P{Greek}
\x41\x{1F600}
\n\r\t\f\a\e\0\077\cA
\/\+\*\?\|\-\#\.\[\]\(\)\{\}\$\^
\\
REGEX;

// ------------------------------------------------------------------
// Supported: character classes
// ------------------------------------------------------------------

$re = <<<REGEX
[abc]
[^abc]
[a-z]
[0-9]
[a-z0-9Q]
[а-яё]
[😀-🤓]
[\x01-\x08]
[\x{41}-\x{4F}]
[[:digit:][:^space:]]
[\d\p{L}\-\]]
[q-]
[[]           # literal [ inside class
[\[]          # escaped [ inside class
[e\\]         # literal backslash before class end
REGEX;

// ------------------------------------------------------------------
// Supported: groups, assertions, comments, and named captures
// ------------------------------------------------------------------

$re = <<<REGEX
(ab)
(?:ab)
(?>ab)
(?|ab)
(?<=ab)
(?<!ab)
(?=ab)
(?!ab)
(?im:ab)
(?x:ab)
(?<word>ab)
(?'word'ab)
(?P<word>ab)
(?# comment)
(?im)
REGEX;

// ------------------------------------------------------------------
// Supported: backreferences and quoted literals
// ------------------------------------------------------------------

$re = <<<REGEX
\1
\k<word>
\k'word'
(?P=word)
\Qa.b+#[](){}|\E
REGEX;

// ------------------------------------------------------------------
// Supported: multiline explicit regex constructs
// ------------------------------------------------------------------

$re = <<<REGEX
/[ab
cd]/
/(ab
cd)/
/(?<word>ab
cd)/
REGEX;

// ------------------------------------------------------------------
// Supported: heredoc interpolation inside explicit regex bodies
// ------------------------------------------------------------------

$re = <<<REGEX
(?<{$interpolatedName}>[{$interpolatedHex}\d]+)
($interpolatedName)
\Q$interpolatedName\E
REGEX;

// ------------------------------------------------------------------
// Supported: nowdoc/raw explicit regex bodies
// ------------------------------------------------------------------

$re = <<<'REGEXP'
\d{3,4}
\x41\p{L}
(?<word>ab)\k<word>
[a-z0-9\x01-\x08]
\Qraw $value stays raw here\E
REGEXP;

// ------------------------------------------------------------------
// Recovery / malformed cases that should not leak past the block
// ------------------------------------------------------------------

$re = <<<REGEX
/[]/
/[^]/
/[a/
/[^a/
/[/
/(ab
/(?# note
/\Qab
REGEX;

$re = <<<'REGEXP'
/[]/
/[^]/
/[a/
/[^a/
/[/
/(ab
/(?# note
/\Qab
REGEXP;

// ------------------------------------------------------------------
// Valid but tricky cases we already handle
// ------------------------------------------------------------------

$re = <<<REGEX
foo/bar\/baz
r\e[g[G]]e(x)
re[g[G]][e\\]
([ab](?:foo)?)
([a-z]{2,4})(?<name>\d+)(?<=end)
REGEX;

// ------------------------------------------------------------------
// Known gaps / partial support in explicit regexes today
// These are useful to keep isolated so later work is easy to compare.
// ------------------------------------------------------------------

$re = <<<REGEX
# line comment with punctuation (currently only partially recognized)
# foo (bar) [baz] {1,2}

# deeper PCRE constructs not implemented yet
(?R)
(?1)
(?&word)
(?(1)yes|no)
(*SKIP)(*FAIL)
(*MARK:label)
\K\X\C
REGEX;

// ------------------------------------------------------------------
// Non-PHP-or-not-regex-specific cases that should stay visually obvious
// ------------------------------------------------------------------

$re = <<<REGEX
\u{00A0}      # PHP string escape in heredoc context, not a regex-specific one
\u1234        # JS-style, not PCRE syntax we currently model
REGEX;

// ------------------------------------------------------------------
// Complex combined blocks
// ------------------------------------------------------------------

$re = <<<REGEX
^(?<type>[^,]*?),(?<data>[^#]*?)(?:#(?<hash>.*))?$
^(?:[0-9a-f]{8}-[0-9a-f]{4}-[1-5][0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}|00000000-0000-0000-0000-000000000000)$
^((?:[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*|"(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])*")@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?|\[(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?|[a-z0-9-]*[a-z0-9]:(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21-\x5a\x53-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])+)\]))$
(?x:
  (?<word>[a-z]+)
  (?:\d{2,4}|(?<suffix>[A-Z]+))?
  (?# grouped comment)
  [a-z0-9\x01-\x08]
)
REGEX;
