TYPO3 extension ``htmltables``
========================================

This extension adds a new content element type to create sophisticated HTML tables by Inline-Relational-Record-Editing (IRRE/Inline)

- Repository:  https://github.com/zarthwork/htmltables
- Issues:      https://github.com/zarthwork/htmltables/issues
- Read online: https://github.com/zarthwork/htmltables
- TER:         https://extensions.typo3.org/extension/htmltables/

## »HTML Tables« in a Nutshell

This extension is designed to easily create HTML tables with the necessary syntax and the most important attributes, using "Inline Relational Record Elements". You can use it as a base for your Web Accessible tables.

## Latest features

### Version 0.9.8
- Show record uids in the rows of the BE form
- Fix rendering of record elements
- Fix tbody rendering

### Version 0.9.7
- Raised compatibility to version 13
- You can now use record elements in addition to RTE bodytexts
- Extension configuration to switch to responsive table mode
- New extension icon
- You'll see a brief cell information in the BE rows

## Installation

```bash
composer req zarthwork/htmltables
```

Please don't forget to include the neccessary typoscripts into the template!

```
 + CType: HtmlTable (htmltables)
```

## Screenshots

Frontend:
![Frontend view](https://raw.githubusercontent.com/zarthwork/htmltables/master/Documentation/Images/frontend-example.png)

Backend:
![Backend view](https://raw.githubusercontent.com/zarthwork/htmltables/master/Documentation/Images/backend-example.png)

## License

In general the TYPO3 core is released under the GNU General Public License version
2 or any later version (`GPL-2.0-or-later`). In order to avoid licensing issues and
incompatibilities this package is licenced under the MIT License. In case  you
duplicate or modify source code, credits are not required but really appreciated.

## Security Contact

In case of finding additional security issues in the TYPO3 project or in this package in particular,
please get in touch with the [TYPO3 Security Team](mailto:security@typo3.org), or directly
report a vulnerability via GitHub.
