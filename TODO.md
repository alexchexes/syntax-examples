# TODO
## Create helper for theme authoring
Write a tool that scans the folder for all example source files, tokenizes them using the corresponding VS Code TextMate grammars, and saves the scopes together with the lines where they are found.
Then, when we edit `textMateRules` for a VS Code theme, we can quickly find all affected files and lines to visually assess whether the change works well across all affected grammars and contexts.

## Add example code groups
Like here: https://uiwjs.github.io/react-codemirror/#/theme/data/monokai
It is a convenient format with multiple language preview windows, although the examples are not perfect.

We could also add "similar code" examples for different languages, arranged into groups such as:
- PHP, Java, C#, Python, Swift, etc. Example class definitions and method usage.
- HTML, XML, maybe TSX / Vue / etc. HTML markup blocks.
- TSX, Vue, and others with a lot of "HTML-like + other language" interpolation.
- JSON / YAML + .ini / .properties maybe. Key/value examples.
- shell / Lua / some old or exotic syntaxes. Common keywords, function calls, etc. Not exactly "similar code", but useful to keep in view.
