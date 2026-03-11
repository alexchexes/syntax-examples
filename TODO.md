# TODO
Write a tool that scans the folder for all example source files, tokenizes them using the corresponding VS Code TextMate grammars, and saves the scopes together with the lines where they are found.
Then, when we edit `textMateRules` for a VS Code theme, we can quickly find all affected files and lines to visually assess whether the change works well across all affected grammars and contexts.

## Other examples:
- [PHPDoc tree-sitter](https://github.com/claytonrcarter/tree-sitter-phpdoc/tree/master/test/corpus)

## https://uiwjs.github.io/react-codemirror/#/theme/data/monokai
Convenient format with multiple language preview windows, although the examples are not perfect.
We would want to add similar code in different languages, arranged into groups such as:
- PHP, Java, C#, Python, Swift, etc
- HTML, XML, maybe TSX / Vue / etc with html markup blocks
- TSX, Vue, and other with much of "HTML-like + other language" interpolation
- JSON / YAML + .ini / .properties maybe
- shell / Lua / some old or exotic syntaxes
