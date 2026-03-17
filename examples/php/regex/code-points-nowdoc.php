<?php
// This file is about NOWDOC patterns only. In a nowdoc, PHP does not consume backslashes at all. That means the number of backslashes you type here is the number of backslashes PCRE receives.
// P.S. For visual parity, `/u` forms left in the same block near the non-/u. Shown in "PCRE sees" note
$patterns = <<<'REGEX'
      😀                # PCRE sees:   /😀/             VALID            literal UTF-8 bytes from source; matches 😀 bytes even without /u
      😀                # PCRE sees:   /😀/u            VALID            same literal bytes, with UTF mode enabled

      \\u{1F600}        # PCRE sees:   /\\u{1F600}/    VALID            doubled backslash in nowdoc stays doubled; matches literal text \u{1F600}
      \\u{1F600}        # PCRE sees:   /\\u{1F600}/u   VALID            same literal-text match; /u does not reinterpret it as a Unicode escape
      \\u1F600          # PCRE sees:   /\\u1F600/      VALID            matches literal text \u1F600
      \\u1F600          # PCRE sees:   /\\u1F600/u     VALID            same as above
      \\x{1F600}        # PCRE sees:   /\\x{1F600}/    VALID            matches literal text \x{1F600}; the braced hex is not parsed because the first \\ makes a literal backslash
      \\x{1F600}        # PCRE sees:   /\\x{1F600}/u   VALID            same as above with /u
      \u{1F600}         # PCRE sees:   /\u{1F600}/     INVALID          PCRE2 in PHP does not support JavaScript-style \u{...}
      \u{1F600}         # PCRE sees:   /\u{1F600}/u    INVALID          /u enables UTF mode, but \u is still unsupported
      \u1F600           # PCRE sees:   /\u1F600/       INVALID          PCRE2 does not support \u...
      \u1F600           # PCRE sees:   /\u1F600/u      INVALID          same as above
      \x{1F600}         # PCRE sees:   /\x{1F600}/     INVALID          braced code point is too large for non-UTF 8-bit mode
      \x{1F600}         # PCRE sees:   /\x{1F600}/u    VALID            braced hex escape in UTF mode; matches 😀
      \x1F600           # PCRE sees:   /\x1F600/       VALID            parsed as \x1F plus literal 600; matches byte 0x1F followed by "600"
      \x1F600           # PCRE sees:   /\x1F600/u      VALID            same parse; /u does not change \x1F + "600"

      \\x{4A}           # PCRE sees:   /\\x{4A}/       VALID            literal backslash + text x{4A} -> matches \x{4A}
      \\x{4A}           # PCRE sees:   /\\x{4A}/u      VALID            same as above
      \\\x{4A}          # PCRE sees:   /\\\x{4A}/      VALID            first two backslashes make a literal \, then hex escape -> matches \J
      \\\x{4A}          # PCRE sees:   /\\\x{4A}/u     VALID            same as above
      \\x4A             # PCRE sees:   /\\x4A/         VALID            matches literal text \x4A, not J
      \\x4A             # PCRE sees:   /\\x4A/u        VALID            same as above
      \u{4A}            # PCRE sees:   /\u{4A}/        INVALID          PCRE2 does not support \u{...}
      \u{4A}            # PCRE sees:   /\u{4A}/u       INVALID          same as above; /u does not help
      \x{4A}            # PCRE sees:   /\x{4A}/        VALID            hex escape -> matches J
      \x{4A}            # PCRE sees:   /\x{4A}/u       VALID            same as above
      \x4A              # PCRE sees:   /\x4A/          VALID            hex escape matches J
      \x4A              # PCRE sees:   /\x4A/u         VALID            same as above

      #---------------------------
      #  Not real code points
      #---------------------------
      \\u{1Q600}        # PCRE sees:   /\\u{1Q600}/    VALID            doubled backslash makes it literal text; matches \u{1Q600}
      \\u{1Q600}        # PCRE sees:   /\\u{1Q600}/u   VALID            same as above
      \\u1Q600          # PCRE sees:   /\\u1Q600/      VALID            matches literal text \u1Q600
      \\u1Q600          # PCRE sees:   /\\u1Q600/u     VALID            same as above
      \\x{1Q600}        # PCRE sees:   /\\x{1Q600}/    VALID            doubled backslash makes it literal text; matches \x{1Q600}
      \\x{1Q600}        # PCRE sees:   /\\x{1Q600}/u   VALID            same as above

      \u{1Q600}         # PCRE sees:   /\u{1Q600}/     INVALID          \u is unsupported before the bogus digits even matter
      \u{1Q600}         # PCRE sees:   /\u{1Q600}/u    INVALID          same as above
      \u1Q600           # PCRE sees:   /\u1Q600/       INVALID          PCRE2 does not support \u...
      \u1Q600           # PCRE sees:   /\u1Q600/u      INVALID          same as above
      \x{1Q600}         # PCRE sees:   /\x{1Q600}/     INVALID          braced hex escape contains non-hex Q
      \x{1Q600}         # PCRE sees:   /\x{1Q600}/u    INVALID          same as above
      \x1Q600           # PCRE sees:   /\x1Q600/       VALID            parsed as \x1 plus literal Q600; matches byte 0x01 followed by "Q600"
      \x1Q600           # PCRE sees:   /\x1Q600/u      VALID            same as above

      \\x{4Q}           # PCRE sees:   /\\x{4Q}/       VALID            doubled backslash makes it literal text; matches \x{4Q}
      \\x{4Q}           # PCRE sees:   /\\x{4Q}/u      VALID            same as above
      \\x4Q             # PCRE sees:   /\\x4Q/         VALID            matches literal text \x4Q
      \\x4Q             # PCRE sees:   /\\x4Q/u        VALID            same as above
      \x{4Q}            # PCRE sees:   /\x{4Q}/        INVALID          braced hex escape contains non-hex Q
      \x{4Q}            # PCRE sees:   /\x{4Q}/u       INVALID          same as above
      \x4Q              # PCRE sees:   /\x4Q/          VALID            parsed as \x4 plus literal Q; matches byte 0x04 followed by "Q"
      \x4Q              # PCRE sees:   /\x4Q/u         VALID            same as above
      \u{4Q}            # PCRE sees:   /\u{4Q}/        INVALID          PCRE2 does not support \u{...}
      \u{4Q}            # PCRE sees:   /\u{4Q}/u       INVALID          same as above
REGEX;
