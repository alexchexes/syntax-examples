<?php
// Mirrors the double-quoted set; for visual parity, `/u` forms left in the same block near the non-/u
// P.S. Since the whole heredoc body is double-quoted-style text, literal backslashes in the notes have to be escaped too
$patterns = <<<REGEX
      😀                # PCRE sees:   /😀/            VALID            literal UTF-8 bytes from source; matches 😀 bytes even without /u
      😀                # PCRE sees:   /😀/u           VALID            literal UTF-8 bytes plus UTF mode; matches 😀 as U+1F600

      \\u{1F600}        # PCRE sees:   /\u{1F600}/     INVALID          double-quoted \\ becomes one backslash, so PCRE2 still gets unsupported \u{...}
      \\u{1F600}        # PCRE sees:   /\u{1F600}/u    INVALID          same as above; /u does not help
      \\u1F600          # PCRE sees:   /\u1F600/       INVALID          double-quoted \\ becomes one backslash, so PCRE2 still gets unsupported \u...
      \\u1F600          # PCRE sees:   /\u1F600/u      INVALID          same as above
      \\x{1F600}        # PCRE sees:   /\x{1F600}/     INVALID          double-quoted \\ becomes one backslash, so PCRE2 sees braced hex in 8-bit mode
      \\x{1F600}        # PCRE sees:   /\x{1F600}/u    VALID            double-quoted \\ becomes one backslash, so PCRE2 matches 😀 in UTF mode
      \u{1F600}         # PCRE sees:   /😀/            VALID            PHP turns \u{1F600} into literal 😀 before PCRE; no /u means byte-wise match
      \u{1F600}         # PCRE sees:   /😀/u           VALID            PHP turns \u{1F600} into literal 😀 before PCRE; /u enables UTF mode
      \u1F600           # PCRE sees:   /\u1F600/       INVALID          PHP double quotes do not support \uHHHH; backslash stays and PCRE2 rejects \u
      \u1F600           # PCRE sees:   /\u1F600/u      INVALID          same as above
      \x{1F600}         # PCRE sees:   /\x{1F600}/     INVALID          PHP double quotes do not parse \x{...}; PCRE2 sees braced hex in 8-bit mode
      \x{1F600}         # PCRE sees:   /\x{1F600}/u    VALID            PHP double quotes do not parse \x{...}; PCRE2 matches 😀 in UTF mode
      \x1F600           # PCRE sees:   /<0x1F>600/     VALID            PHP parses \x1F before PCRE; matches byte 0x1F + "600", not U+1F600
      \x1F600           # PCRE sees:   /<0x1F>600/u    VALID            same bytes as above; /u does not change the parsed string

      \\x{4A}           # PCRE sees:   /\x{4A}/        VALID            double-quoted \\ becomes one backslash; PCRE2 braced hex escape matches J

      \\\x{4A}          # PCRE sees:   ? TODO
      \\\x{4A}          # PCRE sees:   ? TODO
      \\x4A             # PCRE sees:   /\x4A/          VALID            double-quoted \\ becomes one backslash; PCRE2 hex escape matches J
      
      \u{4A}            # PCRE sees:   /J/             VALID            PHP turns \u{4A} into literal J before PCRE
      \u{4A}            # PCRE sees:   /J/u            VALID            PHP turns \u{4A} into literal J before PCRE; /u is harmless here
      \x{4A}            # PCRE sees:   /\x{4A}/        VALID            PHP double quotes do not parse \x{...}; PCRE2 handles it and matches J
      
      \x4A              # PCRE sees:   /J/             VALID            PHP parses \x4A into literal J before PCRE

    
      #---------------------------
      #  Not real code points
      #---------------------------
      \\u{1Q600}        # PCRE sees:   /\u{1Q600}/     INVALID          double-quoted \\ becomes one backslash, so PCRE2 still gets unsupported \u{...}
      \\u{1Q600}        # PCRE sees:   /\u{1Q600}/u    INVALID          same as above
      \\u1Q600          # PCRE sees:   /\u1Q600/       INVALID          double-quoted \\ becomes one backslash, so PCRE2 still gets unsupported \u...
      \\u1Q600          # PCRE sees:   /\u1Q600/u      INVALID          same as above
      \\x{1Q600}        # PCRE sees:   /\x{1Q600}/     INVALID          double-quoted \\ becomes one backslash, so PCRE2 sees non-hex Q in \x{...}
      \\x{1Q600}        # PCRE sees:   /\x{1Q600}/u    INVALID          same as above

      \u{1Q600}         # PCRE sees:   (nothing)       PHP PARSE ERROR  invalid UTF-8 codepoint escape sequence in a heredoc / double-quoted string
      \u{1Q600}         # PCRE sees:   (nothing)       PHP PARSE ERROR  same as above; the mirrored `/u` variant is never reached
      \u1Q600           # PCRE sees:   /\u1Q600/       INVALID          PHP double quotes do not support \uHHHH; backslash stays and PCRE2 rejects \u
      \u1Q600           # PCRE sees:   /\u1Q600/u      INVALID          same as above
      \x{1Q600}         # PCRE sees:   /\x{1Q600}/     INVALID          PHP double quotes do not parse \x{...}; PCRE2 sees non-hex Q in \x{...}
      \x{1Q600}         # PCRE sees:   /\x{1Q600}/u    INVALID          same as above
      \x1Q600           # PCRE sees:   /<0x01>Q600/    VALID            PHP parses \x1 before PCRE; matches byte 0x01 + "Q600"
      \x1Q600           # PCRE sees:   /<0x01>Q600/u   VALID            same bytes as above; /u does not change the parsed string

      \\x{4Q}           # PCRE sees:   /\x{4Q}/        INVALID          double-quoted \\ becomes one backslash, so PCRE2 sees non-hex Q in \x{...}

      \\x4Q             # PCRE sees:   /\x4Q/          VALID            double-quoted \\ becomes one backslash, so PCRE2 reads \x4 then literal Q

      \x{4Q}            # PCRE sees:   /\x{4Q}/        INVALID          PHP double quotes do not parse \x{...}; PCRE2 sees non-hex Q in \x{...}

      \x4Q              # PCRE sees:   /<0x04>Q/       VALID            PHP parses \x4 before PCRE; matches byte 0x04 + "Q"

      \u{4Q}            # PCRE sees:   (nothing)       PHP PARSE ERROR  invalid UTF-8 codepoint escape sequence in a heredoc / double-quoted string      
      \u{4Q}            # PCRE sees:   (nothing)       PHP PARSE ERROR  same as above; the mirrored `/u` variant is never reached
REGEX;
