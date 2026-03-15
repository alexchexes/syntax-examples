<?php
// mirrors the single-quoted set; `/u` is not a thing here, these pairs just track the plain and `/u` variants from that file

$patterns = <<<'REGEX'
      😀                # PCRE sees:   /😀/            VALID            literal UTF-8 bytes from source; matches 😀 bytes even without /u
      😀                # PCRE sees:   /😀/u           VALID            literal UTF-8 bytes plus UTF mode; matches 😀 as U+1F600

      \\u{1F600}        # PCRE sees:   /\u{1F600}/     INVALID          PHP passes literal \u{1F600}; PCRE2 in PHP does not support \u{...}
      \\u{1F600}        # PCRE sees:   /\u{1F600}/u    INVALID          /u enables UTF mode, not JavaScript-style \u{...}
      \\u1F600          # PCRE sees:   /\u1F600/       INVALID          PHP passes literal \u1F600; PCRE2 in PHP does not support \u...
      \\u1F600          # PCRE sees:   /\u1F600/u      INVALID          same as above; /u does not make \u valid
      \\x{1F600}        # PCRE sees:   /\x{1F600}/     INVALID          PCRE2 sees a braced code point, but without /u 0x1F600 is too large for 8-bit mode
      \\x{1F600}        # PCRE sees:   /\x{1F600}/u    VALID            PCRE2 braced hex escape in UTF mode; matches 😀
      \u{1F600}         # PCRE sees:   /\u{1F600}/     INVALID          single-quoted backslash stays literal; same runtime pattern as above
      \u{1F600}         # PCRE sees:   /\u{1F600}/u    INVALID          single-quoted backslash stays literal; /u still does not make \u valid
      \u1F600           # PCRE sees:   /\u1F600/       INVALID          single-quoted backslash stays literal; PCRE2 does not support \u...
      \u1F600           # PCRE sees:   /\u1F600/u      INVALID          same as above
      \x{1F600}         # PCRE sees:   /\x{1F600}/     INVALID          single-quoted backslash stays literal; code point > 0xFF needs /u
      \x{1F600}         # PCRE sees:   /\x{1F600}/u    VALID            single-quoted backslash stays literal; PCRE2 matches 😀 in UTF mode
      \x1F600           # PCRE sees:   /\x1F600/       VALID            PCRE2 reads \x1F, then literal 600; matches byte 0x1F + "600", not U+1F600
      \x1F600           # PCRE sees:   /\x1F600/u      VALID            same bytes as above; /u does not change \x1F + "600"

      \\x{4A}           # PCRE sees:   /\x{4A}/        VALID            single-quoted \\ becomes one backslash; PCRE2 braced hex escape matches J
      \\x4A             # PCRE sees:   /\x4A/          VALID            single-quoted \\ becomes one backslash; PCRE2 hex escape matches J
      \u{4A}            # PCRE sees:   /\u{4A}/        INVALID          single-quoted backslash stays literal; PCRE2 does not support \u{...}
      \u{4A}            # PCRE sees:   /\u{4A}/u       INVALID          same as above; /u does not help
      \x{4A}            # PCRE sees:   /\x{4A}/        VALID            PCRE2 braced hex escape matches J
      \x4A              # PCRE sees:   /\x4A/          VALID            PCRE2 hex escape matches J

      #---------------------------
      #  Not real code points   
      #---------------------------
      \\u{1Q600}        # PCRE sees:   /\u{1Q600}/     INVALID          PHP passes literal \u{1Q600}; PCRE2 rejects \u before the bogus digits matter
      \\u{1Q600}        # PCRE sees:   /\u{1Q600}/u    INVALID          same as above; /u does not help
      \\u1Q600          # PCRE sees:   /\u1Q600/       INVALID          PHP passes literal \u1Q600; PCRE2 does not support \u...
      \\u1Q600          # PCRE sees:   /\u1Q600/u      INVALID          same as above
      \\x{1Q600}        # PCRE sees:   /\x{1Q600}/     INVALID          braced hex escape contains non-hex Q
      \\x{1Q600}        # PCRE sees:   /\x{1Q600}/u    INVALID          same as above; /u does not help

      \u{1Q600}         # PCRE sees:   /\u{1Q600}/     INVALID          single-quoted backslash stays literal; same runtime pattern as above
      \u{1Q600}         # PCRE sees:   /\u{1Q600}/u    INVALID          same as above
      \u1Q600           # PCRE sees:   /\u1Q600/       INVALID          single-quoted backslash stays literal; PCRE2 does not support \u...
      \u1Q600           # PCRE sees:   /\u1Q600/u      INVALID          same as above
      \x{1Q600}         # PCRE sees:   /\x{1Q600}/     INVALID          single-quoted backslash stays literal; braced hex escape contains non-hex Q
      \x{1Q600}         # PCRE sees:   /\x{1Q600}/u    INVALID          same as above
      \x1Q600           # PCRE sees:   /\x1Q600/       VALID            PCRE2 reads \x1, then literal Q600; matches byte 0x01 + "Q600"
      \x1Q600           # PCRE sees:   /\x1Q600/u      VALID            same bytes as above; /u does not change the parsed escape

      \\x{4Q}           # PCRE sees:   /\x{4Q}/        INVALID          braced hex escape contains non-hex Q
      \\x4Q             # PCRE sees:   /\x4Q/          VALID            PCRE2 reads \x4, then literal Q; matches byte 0x04 + "Q"
      \x{4Q}            # PCRE sees:   /\x{4Q}/        INVALID          single-quoted backslash stays literal; braced hex escape contains non-hex Q
      \x4Q              # PCRE sees:   /\x4Q/          VALID            PCRE2 reads \x4, then literal Q; matches byte 0x04 + "Q"
      \u{4Q}            # PCRE sees:   /\u{4Q}/        INVALID          single-quoted backslash stays literal; PCRE2 does not support \u{...}
      \u{4Q}            # PCRE sees:   /\u{4Q}/u       INVALID          same as above
REGEX;
