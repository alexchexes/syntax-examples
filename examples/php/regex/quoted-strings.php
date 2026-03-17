<?php
// This a direct copy-paste from here (JS): https://github.com/RedCMD/regex-syntax-highlighter-vscode/blob/main/syntaxes/tests/test.js *
// Needs adjustements for the actual PHP/PCRE2
$notARegex = '/foo-1/bar[a-z]/$baz(ab)/'; // unescaped delimiter in any context where it requires escaping must prevent entering a "regex" mode so we don't make URIs/paths look like regexes when they're not
$r = '/re[g[G]][e\\]((x)/' + '/[a-z] )/';
$r = '/r\e[g[G]]e(x)/';
$r = '/re[g-[G]]e(x)/';
$r = '/^refs\/tags\/([^ ]+) ([0-9a-f]{40}) ([0-9a-f]{40})?$/';
$r = '/^refs\/tags\/([^ ]+)\0\1\000\777\999 ([0-9a-f]{40}) ([0-9a-f]{40})?$/';
$r = '/["\'](module|(text|application)\/(java|ecma)script|text\/babel)["\']/';
$r = "/[\"'](module|(text|application)\/(java|ecma)script|text\/babel)[\"']/";
$r = '/^data:(?<type>[^,]*?),(?<data>[^#]*?)(?:#(?<hash>.*))?$/';
$r = '/^(?:[34][0-8]|9[0-7]|10[0-7]|[0-9]|2[1-5,7-9]|[34]9|5[8,9]|1[0-9])(?:;[349][0-7]|10[0-7]|[013]|[245]|[34]9)?(?:;[012]?[0-9]?[0-9])*;?m$/';
$r = '/(?:[0-9a-f]{8}-[0-9a-f]{4}-[1-5][0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}|00000000-0000-0000-0000-000000000000)/';
$r = '/^((?:[a-z0-9!#$%&\'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&\'*+\/=?^_`{|}~-]+)*|"(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])*")@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?|\[(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?|[a-z0-9-]*[a-z0-9]:(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21-\x5a\x53-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])+)\]))$/';
$r = '/^(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)$/';
$r = "/[a-z0-9](foo(?# comment {$r} comment)bar)/";
$r = '/\//';
$r = '/\\//';
$r = '/[a/b]/';
$r = '/[]/';

$r = '/^\w+:\/\//';

$r = [
    '/(?<whitespace>[ \t\r\n]+)/',
    '/(?<comment>\/\/.*$|\/\*.*?\*\/)/',
    '/(?<forwardSlash>\/(?!\s))/', // for some reason, Apple ignores single forward slashes before any non-whitespace token
    '/(?<curlyOpen>{)/',
    '/(?<curlyClose>})/',
    '/(?<parenOpen>\()/',
    '/(?<parenClose>\))/',
    '/(?<stringDouble>"(?:\\.|[^"\\]+)*")/',
    "/(?<stringSingle>'(?:''|[^']+)*')/",
    '/(?<stringUnquoted>[A-Za-z_][A-Za-z0-9_.-]*)/',
    '/(?<float>[+-]?\d*\.\d+)/',
    '/(?<integer>[+-]?(0x[a-fA-F\d]+|0[0-7]+|\d+))/',
    "/{$r}(?<{$r}>[+-]?({$r}0x[a-f{$r}A-F\d]+|0[0-7]+|{$r}\d+){$r}){$r}/", // php interpolation
    '/(?<boolean>:true|:false)/',
    '/(?<date>@\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2} [+-]\d{4})/',
    '/(?<assign>=)/',
    '/(?<comma>,)/',
    '/(?<semiColon>;)/',
    '/(?<invalid>.)/',
];

$a = '/\\\xFF/';
$b = '/[.*+\-?^${}()|[\]\\]/';
$c = '/\r\n|\r|\n/';
$d = '/\/\/# sourceMappingURL=[^ ]+$/';
$e = '/<%=\s*([^\s]+)\s*%>/';
$f = '/```suggestion(\u0020*(\r\n|\n))((?<suggestion>[\s\S]*?)(\r\n|\n))?```/';
$g =  '/(?<=^|\s)(?=[a-z])([a-z])(?=.*\1$)\(([^()]*0+)(?<!password|token)\)(?!.*?(password|token))\p{L}(?:(?<=\(\d{3}\))-\1|-\1)(?!\s)/u';


$formats = [
    'color-hex' =>
        '/^#([0-9A-Fa-f]{3,4}|([0-9A-Fa-f]{2}){3,4})$/',
    'date-time' =>
        '/^(\d{4})-(0[1-9]|1[0-2])-(0[1-9]|[12][0-9]|3[01])T([01][0-9]|2[0-3]):([0-5][0-9]):([0-5][0-9]|60)(\.[0-9]+)?(Z|(\+|-)([01][0-9]|2[0-3]):([0-5][0-9]))$/i',
    'date' =>
        '/^(\d{4})-(0[1-9]|1[0-2])-(0[1-9]|[12][0-9]|3[01])$/i',
    'time' =>
        '/^([01][0-9]|2[0-3]):([0-5][0-9]):([0-5][0-9]|60)(\.[0-9]+)?(Z|(\+|-)([01][0-9]|2[0-3]):([0-5][0-9]))$/i',
    'email' =>
        '/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z0-9-]+\.)+[a-zA-Z]{2,}))$/',
    'hostname' =>
        '/^(?=.{1,253}\.?$)[a-z0-9](?:[a-z0-9-]{0,61}[a-z0-9])?(?:\.[a-z0-9](?:[-0-9a-z]{0,61}[0-9a-z])?)*\.?$/i',
    'ipv4' =>
        '/^(?:(?:25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)\.){3}(?:25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)$/',
    'ipv6' =>
        '/^((([0-9a-f]{1,4}:){7}([0-9a-f]{1,4}|:))|(([0-9a-f]{1,4}:){6}(:[0-9a-f]{1,4}|((25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)(\.(25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)){3})|:))|(([0-9a-f]{1,4}:){5}(((:[0-9a-f]{1,4}){1,2})|:((25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)(\.(25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)){3})|:))|(([0-9a-f]{1,4}:){4}(((:[0-9a-f]{1,4}){1,3})|((:[0-9a-f]{1,4})?:((25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)(\.(25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)){3}))|:))|(([0-9a-f]{1,4}:){3}(((:[0-9a-f]{1,4}){1,4})|((:[0-9a-f]{1,4}){0,2}:((25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)(\.(25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)){3}))|:))|(([0-9a-f]{1,4}:){2}(((:[0-9a-f]{1,4}){1,5})|((:[0-9a-f]{1,4}){0,3}:((25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)(\.(25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)){3}))|:))|(([0-9a-f]{1,4}:){1}(((:[0-9a-f]{1,4}){1,6})|((:[0-9a-f]{1,4}){0,4}:((25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)(\.(25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)){3}))|:))|(:(((:[0-9a-f]{1,4}){1,7})|((:[0-9a-f]{1,4}){0,5}:((25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)(\.(25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)){3}))|:)))$/i',
];

$controlCharacters = '/\cA\ca\cM\cm\cJ\cj\cZ\cz  \c@\c*/';

$r = '/(?:^|(?<=<\?php))\s*(namespace)\s+([a-z0-9_\x{7f}-\x{10ffff}\\]+)(?=\s*;)/';


$r = "/\Q.^$[](){}+*?|#\E\d/";
$r = "/\Q$fragment{$foo("/[a-z]/")}\E/";
$r = "/\Qraw $value{$foo("/[a-z]/")} stays raw here\E/";

$r = "/\Q$interpolatedHex{$foo($bar)}\E/";
$r = "/\Q$fragment{$foo($bar)}\E/";
$r = "/\Qraw $value{$foo($bar)} stays raw here\E/";
$r = "/\Qab/";
$r = "/[\q]/";

$r = '/\v\r\n\s\t      [\v\r\n\s\t]/';
$r = "/\v\r\n\s\t      [\v\r\n\s\t]/";
$r = '/\\v\\r\\n\\s\\t [\\v\\r\\n\\s\\t]/';
$r = "/\\v\\r\\n\\s\\t [\\v\\r\\n\\s\\t]/";
<<<REGEX
\v\r\n\s\t      [\v\r\n\s\t]
\\v\\r\\n\\s\\t [\\v\\r\\n\\s\\t]
REGEX;
<<<'REGEX'
\v\r\n\s\t      [\v\r\n\s\t]
\\v\\r\\n\\s\\t [\\v\\r\\n\\s\\t]
REGEX;


// backslash before non-alnum char, `;` is just example, applies to ', " and other
$r = <<<'REGEX'
/\;/                        # matches ;
/\\;/                       # matches \;
/\\\;/                      # matches \;
/\\\\;/                     # matches \\;
/\\\\\;/                    # matches \\;
/\\\\\\;/                   # matches \\\;
/\\\\\\\;/                  # matches \\\;
REGEX;

$r = <<<REGEX
/\;/                 # matches ;
/\\;/                # matches ;
/\\\;/               # matches \;
/\\\\;/              # matches \;
/\\\\\;/             # matches \;
/\\\\\\;/            # matches \;
/\\\\\\\;/           # finally matches \\;
/\\\\\\\\;/          # matches \\;
/\\\\\\\\\;/         # matches \\;
/\\\\\\\\\\;/        # matches \\;
/\\\\\\\\\\\;/       # finally matches \\\;...
REGEX;

$rs = [
    "/\;/",            // matches ;
    "/\\;/",           // matches ;
    "/\\\;/",          // matches \;
    "/\\\\;/",         // matches \;
    "/\\\\\;/",        // matches \;
    "/\\\\\\;/",       // matches \;
    "/\\\\\\\;/",      // finally matches \\;
    "/\\\\\\\\;/",     // matches \\;
    "/\\\\\\\\\;/",    // matches \\;
    "/\\\\\\\\\\;/",   // matches \\;
    "/\\\\\\\\\\\;/",  // finally matches \\\;...

    '/\;/',            // matches ;
    '/\\;/',           // matches ;
    '/\\\;/',          // matches \;
    '/\\\\;/',         // matches \;
    '/\\\\\;/',        // matches \;
    '/\\\\\\;/',       // matches \;
    '/\\\\\\\;/',      // finally, matches \\;
    '/\\\\\\\\;/',     // matches \\;
    '/\\\\\\\\\;/',    // matches \\;
    '/\\\\\\\\\\;/',   // matches \\;
    '/\\\\\\\\\\\;/',  // finally, matches \\\;...
];

// special case when non-alnum is a PHP quoted string escape
$rs = [
    '/\'/',            // matches '
    '/\\\'/',          // matches '
    '/\\\\\'/',        // matches \'
    '/\\\\\\\'/',      // matches \'
    '/\\\\\\\\\'/',    // matches \\'
    '/\\\\\\\\\\\'/',  // matches \\'

    "/\"/",            // matches "
    "/\\\"/",          // matches "
    "/\\\\\"/",        // matches \"
    "/\\\\\\\"/",      // matches \"
    "/\\\\\\\\\"/",    // matches \\"
    "/\\\\\\\\\\\"/",  // matches \\"
];

$input = <<<'TXT'
\\j
\\[a-z]
TXT;

$r = <<<'REGEX'
/[a-z]/                     # matches `j`        (a-z range)
/\[a-z]/                    # matches `[a-z]`    (literal string)
/\\[a-z]/                   # matches `\j`       (\ + a-z range)
/\\\[a-z]/                  # matches `\[a-z]`   (literal string)
/\\\\[a-z]/                 # matches `\\j`      (\\ + a-z range)
/\\\\\[a-z]/                # matches `\\[a-z]`  (literal string)
REGEX;

$r = <<<REGEX
/[a-z]/                     # matches `j`        (a-z range)
/\[a-z]/                    # matches `[a-z]`    (literal string)
/\\[a-z]/                   # matches `[a-z]`    (literal string)
/\\\[a-z]/                  # matches `\j`       (\ + a-z range)
/\\\\[a-z]/                 # matches `\j`       (\ + a-z range)
/\\\\\[a-z]/                # matches `\[a-z]`   (literal string)
/\\\\\\[a-z]/               # matches `\[a-z]`   (literal string)
/\\\\\\\[a-z]/              # matches `\\j`      (\\ + a-z range)
/\\\\\\\\[a-z]/             # matches `\\j`      (\\ + a-z range)
/\\\\\\\\\[a-z]/            # matches `\\[a-z]`  (literal string)
/\\\\\\\\\\[a-z]/           # matches `\\[a-z]`  (literal string)
REGEX;

$rs = [
    '/[a-z]/',             # matches `j`        (a-z range)
    '/\[a-z]/',            # matches `[a-z]`    (literal string)
    '/\\[a-z]/',           # matches `[a-z]`    (literal string)
    '/\\\[a-z]/',          # matches `\j`       (\ + a-z range)
    '/\\\\[a-z]/',         # matches `\j`       (\ + a-z range)
    '/\\\\\[a-z]/',        # matches `\[a-z]`   (literal string)
    '/\\\\\\[a-z]/',       # matches `\[a-z]`   (literal string)
    '/\\\\\\\[a-z]/',      # matches `\\j`      (\\ + a-z range)
    '/\\\\\\\\[a-z]/',     # matches `\\j`      (\\ + a-z range)
    '/\\\\\\\\\[a-z]/',    # matches `\\[a-z]`  (literal string)
    '/\\\\\\\\\\[a-z]/',   # matches `\\[a-z]`  (literal string)

    "/[a-z]/",             # matches `j`        (a-z range)
    "/\[a-z]/",            # matches `[a-z]`    (literal string)
    "/\\[a-z]/",           # matches `[a-z]`    (literal string)
    "/\\\[a-z]/",          # matches `\j`       (\ + a-z range)
    "/\\\\[a-z]/",         # matches `\j`       (\ + a-z range)
    "/\\\\\[a-z]/",        # matches `\[a-z]`   (literal string)
    "/\\\\\\[a-z]/",       # matches `\[a-z]`   (literal string)
    "/\\\\\\\[a-z]/",      # matches `\\j`      (\\ + a-z range)
    "/\\\\\\\\[a-z]/",     # matches `\\j`      (\\ + a-z range)
    "/\\\\\\\\\[a-z]/",    # matches `\\[a-z]`  (literal string)
    "/\\\\\\\\\\[a-z]/",   # matches `\\[a-z]`  (literal string)
];

$input = <<<'TXT'
\\j
\\a-z
TXT;

$r = <<<'REGEX'
/[a-z]/                 # matches `j`, `a`, `z`
/[\a-z]/                # matches `\`, `j`, `a`, `-`, `z`, and a newline (btw, why?)
/[\\a-z]/               # matches `\`, `j`, `a`, `z`
/[\\\a-z]/              # matches `\`, `j`, `a`, `-`, `z`, a newline
REGEX;

<<<REGEX
/[a-z]/                 # matches: `j`, `a`, `z`
/[\a-z]/                # matches: `\`, `j`, `a`, `-`, `z`, and a newline (btw, why?)
/[\\a-z]/               # matches: `\`, `j`, `a`, `-`, `z`, a newline
/[\\\a-z]/              # matches: `\`, `j`, `a`, `z`
/[\\\\a-z]/             # matches: `\`, `j`, `a`, `z`
/[\\\\\a-z]/            # matches: `\`, `j`, `a`, `-`, `z`, a newline
/[\\\\\\a-z]/           # matches: `\`, `j`, `a`, `-`, `z`, a newline
/[\\\\\\\a-z]/          # matches: `\`, `j`, `a`, `z` ...
REGEX;

$rs = [
    '/[a-z]/',                 # matches: `j`, `a`, `z`
    '/[\a-z]/',                # matches: `\`, `j`, `a`, `-`, `z`, a newline
    '/[\\a-z]/',               # matches: `\`, `j`, `a`, `-`, `z`, a newline
    '/[\\\a-z]/',              # matches: `\`, `j`, `a`, `z`
    '/[\\\\a-z]/',             # matches: `\`, `j`, `a`, `z`
    '/[\\\\\a-z]/',            # matches: `\`, `j`, `a`, `-`, `z`, a newline
    '/[\\\\\\a-z]/',           # matches: `\`, `j`, `a`, `-`, `z`, a newline
    '/[\\\\\\\a-z]/',          # matches: `\`, `j`, `a`, `z`

    "/[a-z]/",                 # matches: `j`, `a`, `z`
    "/[\a-z]/",                # matches: `\`, `j`, `a`, `-`, `z`, a newline
    "/[\\a-z]/",               # matches: `\`, `j`, `a`, `-`, `z`, a newline
    "/[\\\a-z]/",              # matches: `\`, `j`, `a`, `z`
    "/[\\\\a-z]/",             # matches: `\`, `j`, `a`, `z`
    "/[\\\\\a-z]/",            # matches: `\`, `j`, `a`, `-`, `z`, a newline
    "/[\\\\\\a-z]/",           # matches: `\`, `j`, `a`, `-`, `z`, a newline
    "/[\\\\\\\a-z]/",          # matches: `\`, `j`, `a`, `z`
];

$rs = [
    "/['a-z]/",                 # matches: `j`, `a`, `z`, `'`
    "/[\'a-z]/",                # matches: `j`, `a`, `z`, `'`
    "/[\\'a-z]/",               # matches: `j`, `a`, `z`, `'`
    "/[\\\'a-z]/",              # matches: `\`, `j`, `a`, `z`, `'`
    "/[\\\\'a-z]/",             # matches: `\`, `j`, `a`, `z`, `'`
    "/[\\\\\'a-z]/",            # matches: `\`, `j`, `a`, `z`, `'`
    "/[\\\\\\'a-z]/",           # matches: `\`, `j`, `a`, `z`, `'`
    "/[\\\\\\\'a-z]/",          # matches: `\`, `j`, `a`, `z`, `'`
    
    '/["a-z]/',                 # matches: `j`, `a`, `z`, `"`
    '/[\"a-z]/',                # matches: `j`, `a`, `z`, `"`
    '/[\\"a-z]/',               # matches: `j`, `a`, `z`, `"`
    '/[\\\"a-z]/',              # matches: `\`, `j`, `a`, `z`, `"`
    '/[\\\\"a-z]/',             # matches: `\`, `j`, `a`, `z`, `"`
    '/[\\\\\"a-z]/',            # matches: `\`, `j`, `a`, `z`, `"`
    '/[\\\\\\"a-z]/',           # matches: `\`, `j`, `a`, `z`, `"`
    '/[\\\\\\\"a-z]/',          # matches: `\`, `j`, `a`, `z`, `"`

    '/[\'a-z]/',                # matches: `j`, `a`, `z`, `'`
    '/[\\\'a-z]/',              # matches: `j`, `a`, `z`, `'`
    '/[\\\\\'a-z]/',            # matches: `\`, `j`, `a`, `z`, `'`
    '/[\\\\\\\'a-z]/',          # matches: `\`, `j`, `a`, `z`, `'`

    "/[\"a-z]/",                # matches: `j`, `a`, `z`, `"`
    "/[\\\"a-z]/",              # matches: `j`, `a`, `z`, `"`
    "/[\\\\\"a-z]/",            # matches: `\`, `j`, `a`, `z`, `"`
    "/[\\\\\\\"a-z]/",          # matches: `\`, `j`, `a`, `z`, `"`
];

<<<REGEX
/['a-z]/                # matches: `j`, `a`, `z`, `'`
/[\'a-z]/               # matches: `j`, `a`, `z`, `'`
/[\\'a-z]/              # matches: `j`, `a`, `z`, `'`
/[\\\'a-z]/             # matches: `\`, `j`, `a`, `z`, `'`
/[\\\\'a-z]/            # matches: `\`, `j`, `a`, `z`, `'`
/[\\\\\'a-z]/           # matches: `\`, `j`, `a`, `z`, `'`
/[\\\\\\'a-z]/          # matches: `\`, `j`, `a`, `z`, `'`
/[\\\\\\\'a-z]/         # matches: `\`, `j`, `a`, `z`, `'`

/["a-z]/                # matches: `j`, `a`, `z`, `"`
/[\"a-z]/               # matches: `j`, `a`, `z`, `"`
/[\\"a-z]/              # matches: `j`, `a`, `z`, `"`
/[\\\"a-z]/             # matches: `\`, `j`, `a`, `z`, `"`
/[\\\\"a-z]/            # matches: `\`, `j`, `a`, `z`, `"`
/[\\\\\"a-z]/           # matches: `\`, `j`, `a`, `z`, `"`
/[\\\\\\"a-z]/          # matches: `\`, `j`, `a`, `z`, `"`
/[\\\\\\\"a-z]/         # matches: `\`, `j`, `a`, `z`, `"`

/[\'a-z]/               # matches: `j`, `a`, `z`, `'`
/[\\\'a-z]/             # matches: `\`, `j`, `a`, `z`, `'`
/[\\\\\'a-z]/           # matches: `\`, `j`, `a`, `z`, `'`
/[\\\\\\\'a-z]/         # matches: `\`, `j`, `a`, `z`, `'`

/[\"a-z]/               # matches: `j`, `a`, `z`, `"`
/[\\\"a-z]/             # matches: `\`, `j`, `a`, `z`, `"`
/[\\\\\"a-z]/           # matches: `\`, `j`, `a`, `z`, `"`
/[\\\\\\\"a-z]/         # matches: `\`, `j`, `a`, `z`, `"`
REGEX;

<<<'REGEX'
/['a-z]/                # matches: `j`, `a`, `z`, `'`
/[\'a-z]/               # matches: `j`, `a`, `z`, `'`
/[\\'a-z]/              # matches: `\`, `j`, `a`, `z`, `'`
/[\\\'a-z]/             # matches: `\`, `j`, `a`, `z`, `'`
/[\\\\'a-z]/            # matches: `\`, `j`, `a`, `z`, `'`
/[\\\\\'a-z]/           # matches: `\`, `j`, `a`, `z`, `'`
/[\\\\\\'a-z]/          # matches: `\`, `j`, `a`, `z`, `'`
/[\\\\\\\'a-z]/         # matches: `\`, `j`, `a`, `z`, `'`

/["a-z]/                # matches: `j`, `a`, `z`, `"`
/[\"a-z]/               # matches: `j`, `a`, `z`, `"`
/[\\"a-z]/              # matches: `\`, `j`, `a`, `z`, `"`
/[\\\"a-z]/             # matches: `\`, `j`, `a`, `z`, `"`
/[\\\\"a-z]/            # matches: `\`, `j`, `a`, `z`, `"`
/[\\\\\"a-z]/           # matches: `\`, `j`, `a`, `z`, `"`
/[\\\\\\"a-z]/          # matches: `\`, `j`, `a`, `z`, `"`
/[\\\\\\\"a-z]/         # matches: `\`, `j`, `a`, `z`, `"`

/[\'a-z]/               # matches: `j`, `a`, `z`, `'`
/[\\\'a-z]/             # matches: `\`, `j`, `a`, `z`, `'`
/[\\\\\'a-z]/           # matches: `\`, `j`, `a`, `z`, `'`
/[\\\\\\\'a-z]/         # matches: `\`, `j`, `a`, `z`, `'`

/[\"a-z]/               # matches: `j`, `a`, `z`, `"`
/[\\\"a-z]/             # matches: `\`, `j`, `a`, `z`, `"`
/[\\\\\"a-z]/           # matches: `\`, `j`, `a`, `z`, `"`
/[\\\\\\\"a-z]/         # matches: `\`, `j`, `a`, `z`, `"`
REGEX;

$rs = [
    '/a/b/',                   # Internal error
    '/a\/b/',                  # matches: `a/b`
    '/a\\/b/',                 # matches: `a/b`
    '/a\\\/b/',                # Internal error
    '/a\\\\/b/',               # Internal error
    '/a\\\\\/b/',              # matches: `a\/b`
    '/a\\\\\\/b/',             # matches: `a\/b`

    '/a/b/ ',                  # Internal error
    '/a\/b/',                  # matches: `a/b`
    '/a\\/b/',                 # matches: `a/b`
    '/a\\\/b/',                # Internal error
    '/a\\\\/b/',               # Internal error
    '/a\\\\\/b/',              # matches: `a\/b`
    '/a\\\\\\/b/',             # matches: `a\/b`
    '/a\\\\\\\/b/',            # Internal error
    '/a\\\\\\\\/b/',           # Internal error
    '/a\\\\\\\\\/b/',          # matches: `a\\/b`
    '/a\\\\\\\\\\/b/',         # matches: `a\\/b`
    '/a\\\\\\\\\\\/b/',        # Internal error
];

<<<'REGEX'
/a/b/                   # Internal error
/a\/b/                  # matches: `a/b`
/a\\/b/                 # Internal error
/a\\\/b/                # matches: `a\/b`
/a\\\\/b/               # Internal error
/a\\\\\/b/              # matches: `a\\/b`
/a\\\\\\/b/             # Internal error
REGEX;

<<<REGEX
/a/b/                   # Internal error
/a\/b/                  # matches: `a/b`
/a\\/b/                 # matches: `a/b`
/a\\\/b/                # Internal error
/a\\\\/b/               # Internal error
/a\\\\\/b/              # matches: `a\/b`
/a\\\\\\/b/             # matches: `a\/b`
/a\\\\\\\/b/            # Internal error
/a\\\\\\\\/b/           # Internal error
/a\\\\\\\\\/b/          # matches: `a\\/b`
/a\\\\\\\\\\/b/         # matches: `a\\/b`
/a\\\\\\\\\\\/b/        # Internal error
REGEX;




/*---------------------------------------*
*  known limitations / unhandled cases:  *
*----------------------------------------*/
// double-quoted regex with interpolation that contains a delimiter or double quote
$r = "/[a-z]{$foo('/[a-z]/')}[a-z]/";
$r = "/[a-z]{$foo('"foooo"')}[a-z]/";
// without offending charachters it works:
$r = "/[a-z]{$foo('bar')}[a-z]/";

// combining parts:
$r = "/[a-z](" . $foo . ")[a-z]/";

