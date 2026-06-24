# Theme Screenshot Corpus

Temporary corpus for checking Clever Monokai screenshots. This directory is ignored by git via `/tmp/`.

## Source Repositories

- GitHub Linguist samples: https://github.com/github-linguist/linguist/tree/main/samples
- highlight.js detection samples: https://github.com/highlightjs/highlight.js/tree/main/test/detect

## Theme Rule Priority

Approximate language-targeted hits from `themes/clever-monokai-color-theme.json`:

| Area | Hits | Rules |
| --- | ---: | ---: |
| HTML | 176 | 24 |
| PHP | 154 | 44 |
| Markdown | 81 | 44 |
| Vue | 71 | 18 |
| RegExp | 46 | 14 |
| CSS/PostCSS | 32 | 13 |
| Python | 22 | 14 |
| YAML | 20 | 4 |
| JavaScript/TypeScript | 13 | 10 |
| JSON/JSONC | 11 | 5 |
| Shell/Bash | 10 | 8 |
| Smarty | 10 | 8 |
| TOML/INI | 5 | 3 |
| XML | 5 | 2 |
| SQL | 4 | 3 |
| PowerShell | 3 | 3 |
| Ruby | 1 | 1 |

## Suggested Screenshot Set

- `php/highlightjs-default.php`
- `vue/linguist-pre-processors.vue`
- `javascript/highlightjs-jsx-sample.jsx`
- `typescript/linguist-condition-parser.mts`
- `html/linguist-pages.html`
- `css/linguist-sample.postcss`
- `python/linguist-flask-view.py`
- `json/linguist-coc.jsonc`
- `yaml/linguist-coredns.yaml`
- `shell/linguist-rvm.bash`
- `markdown/linguist-readme.md`

## Rust Options

- `rust/modern-async-traits.rs` - compact modern syntax: `async fn` in traits, RPITIT, `LazyLock`, `let else`, raw strings, match guards.
- `rust/modern-patterns-const-lazy.rs` - inline `const`, `LazyLock`, `OnceLock`, macros, slice patterns, `let else`.
- `rust/modern-error-generics.rs` - generics, `where` clauses, custom errors, `Deref`, `Cow`, match guards.
- `rust/tokio-chat.rs` - real async Tokio chat server.
- `rust/tokio-graceful-shutdown.rs` - real Tokio graceful shutdown example.
- `rust/linguist-hashmap.rs` - larger real Rust standard-library-style sample.
