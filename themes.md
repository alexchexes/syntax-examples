# Popular VS Code Themes

Last refreshed: `2026-03-21`

## Method

- Queried the official VS Code Marketplace gallery API for extensions in the `Themes` category, targeting `Microsoft.VisualStudio.Code`.
- Fetched each extension manifest and kept only extensions that actually contribute `themes`.
- Ranked results by Marketplace `install` count.
- Excluded icon-theme packages, deprecated packages, and non-theme bundles or language extensions that happen to ship a theme.

## Notes

- Install counts are tracked per extension, not per individual theme inside a pack.
- Multi-theme packs like GitHub Theme, Ayu, Noctis, and Bearded Theme count once.
- This is a popularity list, not a quality ranking.

## Top Standalone Theme Extensions By Installs

| # | Theme | Installs | Rating | Ratings | Themes in pack | Last updated |
| --- | --- | ---: | ---: | ---: | ---: | --- |
| 1 | [GitHub Theme](https://marketplace.visualstudio.com/items?itemName=GitHub.github-vscode-theme) | 18.5M | 4.58 | 165 | 9 | 2024-10-03 |
| 2 | [One Dark Pro](https://marketplace.visualstudio.com/items?itemName=zhuangtongfa.Material-theme) | 12.1M | 4.67 | 221 | 5 | 2025-02-09 |
| 3 | [Dracula Theme Official](https://marketplace.visualstudio.com/items?itemName=dracula-theme.theme-dracula) | 10.2M | 4.78 | 167 | 2 | 2024-07-17 |
| 4 | [Atom One Dark Theme](https://marketplace.visualstudio.com/items?itemName=akamud.vscode-theme-onedark) | 7.0M | 4.78 | 135 | 1 | 2022-10-08 |
| 5 | [Ayu](https://marketplace.visualstudio.com/items?itemName=teabyii.ayu) | 4.0M | 4.77 | 130 | 6 | 2026-02-28 |
| 6 | [Monokai Pro](https://marketplace.visualstudio.com/items?itemName=monokai.theme-monokai-pro-vscode) | 3.9M | 3.60 | 296 | 8 | 2026-01-07 |
| 7 | [Community Material Theme](https://marketplace.visualstudio.com/items?itemName=Equinusocio.vsc-community-material-theme) | 3.7M | 4.80 | 10 | 10 | 2024-06-12 |
| 8 | [Winter is Coming Theme](https://marketplace.visualstudio.com/items?itemName=johnpapa.winteriscoming) | 3.6M | 4.56 | 48 | 6 | 2021-03-08 |
| 9 | [Night Owl](https://marketplace.visualstudio.com/items?itemName=sdras.night-owl) | 3.4M | 4.85 | 143 | 4 | 2024-12-31 |
| 10 | [One Monokai Theme](https://marketplace.visualstudio.com/items?itemName=azemoh.one-monokai) | 2.8M | 4.90 | 99 | 1 | 2024-08-20 |
| 11 | [Tokyo Night](https://marketplace.visualstudio.com/items?itemName=enkia.tokyo-night) | 2.6M | 4.97 | 66 | 3 | 2025-02-05 |
| 12 | [Palenight Theme](https://marketplace.visualstudio.com/items?itemName=whizkydee.material-palenight-theme) | 2.5M | 4.93 | 72 | 4 | 2024-10-20 |
| 13 | [SynthWave '84](https://marketplace.visualstudio.com/items?itemName=RobbOwen.synthwave-vscode) | 2.4M | 4.80 | 196 | 1 | 2025-07-17 |
| 14 | [Shades of Purple](https://marketplace.visualstudio.com/items?itemName=ahmadawais.shades-of-purple) | 2.3M | 4.93 | 179 | 2 | 2025-10-15 |
| 15 | [Cobalt2 Theme Official](https://marketplace.visualstudio.com/items?itemName=wesbos.theme-cobalt2) | 1.8M | 4.75 | 81 | 1 | 2025-01-07 |
| 16 | [Andromeda](https://marketplace.visualstudio.com/items?itemName=EliverLara.andromeda) | 1.6M | 4.95 | 102 | 5 | 2026-01-09 |
| 17 | [Theme](https://marketplace.visualstudio.com/items?itemName=tal7aouy.theme) | 1.5M | 4.76 | 34 | 4 | 2023-09-27 |
| 18 | [Atom One Light Theme](https://marketplace.visualstudio.com/items?itemName=akamud.vscode-theme-onelight) | 1.4M | 4.92 | 36 | 1 | 2022-10-08 |
| 19 | [Bearded Theme](https://marketplace.visualstudio.com/items?itemName=BeardedBear.beardedtheme) | 1.4M | 4.92 | 135 | 64 | 2025-04-21 |
| 20 | [Noctis](https://marketplace.visualstudio.com/items?itemName=liviuschera.noctis) | 1.3M | 4.94 | 94 | 11 | 2024-03-27 |
| 21 | [Panda Theme](https://marketplace.visualstudio.com/items?itemName=tinkertrain.theme-panda) | 1.2M | 4.72 | 46 | 1 | 2025-04-03 |
| 22 | [Nord](https://marketplace.visualstudio.com/items?itemName=arcticicestudio.nord-visual-studio-code) | 1.2M | 4.87 | 90 | 1 | 2021-09-25 |
| 23 | [Catppuccin for VSCode](https://marketplace.visualstudio.com/items?itemName=Catppuccin.catppuccin-vsc) | 1.1M | 4.96 | 54 | 4 | 2025-10-12 |
| 24 | [Sublime Material Theme](https://marketplace.visualstudio.com/items?itemName=jprestidge.theme-material-theme) | 1.0M | 4.48 | 29 | 2 | 2016-11-27 |
| 25 | [Omni Theme](https://marketplace.visualstudio.com/items?itemName=rocketseat.theme-omni) | 972.3K | 4.90 | 30 | 1 | 2021-11-03 |

## High-Install Entries Excluded From The Main List

- [Material Icon Theme](https://marketplace.visualstudio.com/items?itemName=PKief.material-icon-theme): `33.3M` installs. Icon theme package, not a color-theme pack.
- [vscode-icons](https://marketplace.visualstudio.com/items?itemName=vscode-icons-team.vscode-icons): `23.5M` installs. Icon theme package, not a color-theme pack.
- [C/C++ Themes](https://marketplace.visualstudio.com/items?itemName=ms-vscode.cpptools-themes): `53.9M` installs. Companion theme extension tied to C/C++ tooling.
- [PowerShell](https://marketplace.visualstudio.com/items?itemName=ms-vscode.PowerShell): `18.5M` installs. Language tooling extension that ships a theme.
- [Material Theme - Deprecated](https://marketplace.visualstudio.com/items?itemName=Equinusocio.vsc-material-theme): `4.2M` installs. Deprecated package.
- [Ruby](https://marketplace.visualstudio.com/items?itemName=Shopify.ruby-extensions-pack): `689.7K` installs. Ruby extension pack that bundles themes.

## Source

- VS Code Marketplace Gallery API: `https://marketplace.visualstudio.com/_apis/public/gallery/extensionquery`
- Individual Marketplace pages linked above for each extension.
