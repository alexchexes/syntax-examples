<?php

// Visual inventory for explicit REGEX / REGEXP heredoc and nowdoc support.
// This file is intentionally organized as:
// - isolated supported cases
// - same constructs in interpolating and raw hosts
// - malformed / recovery samples
// - known gaps that are still mostly plain text today
// - longer stress cases that combine many constructs

$fragment = '[A-Z][A-Z0-9_]*';
$captureName = 'token';
$interpolatedHex = 'A-F';
$separator = '[-._]';
$makeFragment = fn($s) => null;

// Supported basics: anchors, dot, alternation, simple quantifiers.
$supportedBasics = <<<'REGEX'
/simple/
^foo$
\Afoo\bbar\Bbaz\Gqux\Z\z
colou?r
a*?
ab+c*de?
a+?|b*?|c??|d{3}|e{3,4}|f{3,}|g{,4}?|h{3,4}+
\d{3,4}
\d{,4}?
\w{2,}
\p{L}{1,3}+
foo|bar|baz
.
REGEX;

// Supported escapes outside character classes.
$supportedEscapes = <<<'REGEX'
\d\D\w\W\s\S\h\H\v\V\R
\p{L}\P{Greek}
\n\r\t\f\a\e
\xFF\x{1F600}
\0\077\cA
\\
\/\.\+\*\?\|\-\#\[\]\(\)\{\}\$\^
\Q.^$[](){}+*?|#\E\d
REGEX;

// Supported character classes and class internals.
$supportedCharacterClasses = <<<'REGEX'
[abc]
[^abc]
[a-z]
[a-z0-9Q]
[a-zQ]
[0-9]
[A-F0-9]
[а-яё]
[😀-🤓]
[\x01-\x08\x0b\x0c\x0e-\x1f]
[\x{4A}-\x{4f}J]
[[:digit:][:^space:]]
[\d\p{L}\-\]]
[q-]
[[] 
[\[] 
[e\\]
[g[G]]
REGEX;

// Supported groups, assertions, comments, option groups, and names.
$supportedGroups = <<<'REGEX'
(ab)
(?:ab)
(?>ab)
(?|ab|cd)
(?=ab)
(?!ab)
(?<=ab)
(?<!ab)
(?im)
(?im:ab)
(?x:
  a \s+ b
)
(?<word>ab)
(?'word'ab)
(?P<word>ab)
(?# comment inside group)
REGEX;

// Supported backreferences and named backreferences.
$supportedBackreferences = <<<'REGEX'
\1
\k<word>
\k'word'
(?P=word)
(ab)\1
(?<word>ab)\k<word>
(?'word'ab)\k'word'
(?P<word>ab)(?P=word)
((foo))(?:bar)\2
REGEX;

// in heredoc, PHP must win for its sequences unless double-escaped
$r = <<<REGEX
\1          \x41            \u{41}
\n          \v              \$
[\1-\3]     [\x41-\x43]     [\u{41}-\u{43}]
[\n-\t]     [\v]            [\$-\\]

\\1         \\x41           \\u{41}
\\n         \\v             \\$
[\\1-\\3]   [\\x41-\\x43]  [\\u{41}-\\u{43}]
[\\n-\\t]   [\\v]          [\\$-\\^]

\    \\     \/    \\\    \\/
\.   \(     \[     \{     \*
\\.  \\(a)  \\[a]  \\{a}  \\*

[\]    [\\]     [\/]      [\\\]     [\\/]
[\.]   [\(]     [\[]      [\{]      [\*]
[\\.]  [\\(a)]  [\\[a]]   [\\{a}]   [\\*]

# regression control
\d          \p{L}             \x{41}
[\d-\w]     [\p{L}-\p{N}]     [\x{41}\x{42}-\x{44}]

\\d         \\p{L}            \\x{41}
[\\d-\\w]   [\\p{L}-\\p{N}]   [\\x{41}\x{42}-\\x{44}]
REGEX;

// in nowdoc, no such problem, almost everything is regex-first
$r = <<<'REGEX'
\1          \x41            \u{41}
\n          \v              \$
[\1-\3]     [\x41-\x43]     [\u{41}-\u{43}]
[\n-\t]     [\v]            [\$-\\]

\\1         \\x41           \\u{41}
\\n         \\v             \\$
[\\1-\\3]   [\\x41-\\x43]  [\\u{41}-\\u{43}]
[\\n-\\t]   [\\v]          [\\$-\\^]

\    \\     \/    \\\    \\/
\.   \(     \[     \{     \*
\\.  \\(a)  \\[a]  \\{a}  \\*

[\]    [\\]     [\/]      [\\\]     [\\/]
[\.]   [\(]     [\[]      [\{]      [\*]
[\\.]  [\\(a)]  [\\[a]]   [\\{a}]   [\\*]

# regression control
\d          \p{L}             \x{41}
[\d-\w]     [\p{L}-\p{N}]     [\x{41}\x{42}-\x{44}]

\\d         \\p{L}            \\x{41}
[\\d-\\w]   [\\p{L}-\\p{N}]   [\\x{41}\x{42}-\\x{44}]
REGEX;

// Supported multiline nesting in explicit blocks.
$supportedMultiline = <<<'REGEXP'
/[abc-e
fgx-z]/
/(ab|
c
|de)/
/(?<word>ab
cd)/
(
  [abc-e
  fg-lxz]
  (?<word>
    foo
    bar
  )
  (?:baz
    qux
  )?
)
REGEXP;

// Supported interpolation in REGEXP heredoc.
$supportedInterpolation = <<<REGEXP
(?<{$captureName}>[{$interpolatedHex}\d]+)
(?<{$captureName}>$fragment(?:$separator$fragment{$makeFragment("REGEXP;")})*)
($fragment)
($fragment{$makeFragment("/(\"\'[a-z]|\d+)/ui")})
\Q$interpolatedHex\E
\Q$fragment{$makeFragment("/(\"\'[a-z]|\d+)/ui")}\E
(?# interpolation is still available here: $fragment)
REGEXP;

// No interpolation inside nowdoc
$noInterpolationInNowdoc = <<<'REGEXP'
(?<{$captureName}>[{$interpolatedHex}\d]+)
(?<{$captureName}>$fragment(?:$separator$fragment{$makeFragment("REGEXP;")})*)
($fragment)
($fragment{$makeFragment("/(\"\'[a-z]|\d+)/ui")})
\Q$interpolatedHex\E
\Q$fragment{$makeFragment("/(\"\'[a-z]|\d+)/ui")}\E
REGEXP;

// Same family in nowdoc: raw text instead of interpolation.
$supportedRawNowdoc = <<<'REGEX'
\d{3,4}
\x41\p{L}
(?<word>ab)\k<word>
[a-z0-9\x01-\x08]
(?<word>\w+)
($fragment)
\Q$fragment\E
\Qraw $value stays raw here\E
$fragment
REGEX;


// Character class edge cases we intentionally keep stable.
$classEdgeCases = <<<'REGEX'
re[g[G]][e\\]
r\e[g[G]]e(x)
[Qa-cQx-zQ]
[g[G]]
[e\\]
[[] 
[\[] 
REGEX;

// Malformed / recovery cases that should not poison later code.
$recoveryCases = <<<'REGEX'
/[]/
/[^]/
/[a/
/[^a/
/[/
/(ab
/(?# note
/\Qab
REGEX;

// Valid but intentionally tricky explicit-regex cases.
$trickyButSupported = <<<'REGEX'
foo/bar\/baz
(\()
(\\)(ab){2,3}
\\[\x01-\x09\x0b\x0c\x0e-\x7f]
([\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])
([ab](?:foo)?)
([a-z]{2,4})(?<name>\d+)(?<=end)
REGEX;

// Known gaps / partial support today.
// These are useful to re-check after deeper PCRE support lands.
$knownGaps = <<<'REGEXP'
# line comment with punctuation (currently only partially recognized)
(?R)
(?1)
(?&word)
(?(1)yes|no)
(*SKIP)(*FAIL)
(*MARK:label)
\K\X\C\N
# foo (bar) [baz] {qux}
REGEXP;

// Not modeled as regex-specific codepoint syntax.
// In interpolating hosts \u{...} is still a PHP string escape.
$phpStringVsRegex = <<<REGEXP
\u{00A0}
$fragment
REGEXP;

$rawPhpStringVsRegex = <<<'REGEX'
\u{00A0}
\u1234
REGEX;

// Non-PCRE or intentionally invalid samples kept isolated.
$invalidOrOtherDialect = <<<'REGEX'
[g-[G]]
\u1234
[\q]
REGEX;

// Combined stress block: named groups, comments, classes, escapes.
$combinedStress = <<<'REGEXP'
^(?<type>[^,]*?),(?<data>[^#]*?)(?:#(?<hash>.*))?$
^(?:[0-9a-f]{8}-[0-9a-f]{4}-[1-5][0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}|00000000-0000-0000-0000-000000000000)$
^(?x:
  data:
  (?<type>[^,]*?)
  ,
  (?<data>[^#]*?)
  (?: \# (?<hash>.*) )?
)$
REGEXP;

// Combined stress block with many nested structures and ranges.
$combinedStressRaw = <<<'REGEX'
^((?:[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'"*+/=?^_`{|}~-]+)*)@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-zQ0-9-]*[a-z0-9])?|\[(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?|[a-z0-9-]*[a-z0-9]:(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21-\x5a\x53-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])+)\]))$
(?x:
  (?<word>[a-z]+)
  (?:\d{2,4}|(?<suffix>[A-Z]+))?
  (?# grouped comment)
  [a-z0-9\x01-\x08]
)
REGEX;

// Structured multiline block that mixes groups, ranges, escapes, and raw text.
$structuredMultilineRaw = <<<'REGEX'
(?x:
  ^
  (?<namespace>[A-Za-z_\x{7f}-\x{10ffff}\\]+)
  (?:
    ::
    (?<member>[A-Za-z_][A-Za-z0-9_]*)
  )?
  (?:
    \[
      (?<index>
        [0-9]
        |
        [1-9][0-9]*
      )
    \]
  )*
  $
)
REGEX;

// Structured multiline heredoc block with interpolation intentionally present.
$structuredMultilineInterpolated = <<<REGEXP
(?x:
  ^
  (?<{$captureName}>
    $fragment
    (?:
      $separator
      $fragment
    )*
  )
  (?:
    \[
      (?<index>\d+)
    \]
  )*
  $
)
REGEXP;

// backslash handling tests
"/ \/ \\ \\\/ \\\\/ \1 \\1 [\/ \\ \\\/ \\\\/ \1 \\1] /";
'/ \/ \\ \\\/ \\\\/ \1 \\1 [\/ \\ \\\/ \\\\/ \1 \\1] /';
<<<REGEX
 \/ \\ \\\/ \\\\/ \1 \\1 [\/ \\ \\\/ \\\\/ \1 \\1]
REGEX;
<<<'REGEX'
 \/ \\ \\\/ \\\\/ \1 \\1 [\/ \\ \\\/ \\\\/ \1 \\1]
REGEX;

"/ \/ \\ \\\/ \\\\\/ \1 \\1 [\/ \\ \\\/ \\\\\/ \1 \\1] /";
'/ \/ \\ \\\/ \\\\\/ \1 \\1 [\/ \\ \\\/ \\\\\/ \1 \\1] /';
<<<REGEX
 \/ \\ \\\/ \\\\\/ \1 \\1 [\/ \\ \\\/ \\\\\/ \1 \\1]
REGEX;
<<<'REGEX'
 \/ \\ \\\/ \\\\\/ \1 \\1 [\/ \\ \\\/ \\\\\/ \1 \\1]
REGEX;

"/ \/ \\ \\/ \\\\\/ \1 \\1 [\/ \\ \\/ \\\\\/ \1 \\1] /";
'/ \/ \\ \\/ \\\\\/ \1 \\1 [\/ \\ \\/ \\\\\/ \1 \\1] /';
<<<REGEX
 \/ \\ \\/ \\\\\/ \1 \\1 [\/ \\ \\/ \\\\\/ \1 \\1]
REGEX;
<<<'REGEX'
 \/ \\ \\/ \\\\\/ \1 \\1 [\/ \\ \\/ \\\\\/ \1 \\1]
REGEX;