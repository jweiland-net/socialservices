# TYPO3 Extension `socialservices`

[![Packagist][packagist-logo-stable]][extension-packagist-url]
[![Latest Stable Version][extension-build-shield]][extension-ter-url]
[![Total Downloads][extension-downloads-badge]][extension-packagist-url]
[![Monthly Downloads][extension-monthly-downloads]][extension-packagist-url]
[![TYPO3 13.4][TYPO3-shield]][TYPO3-13-url]

![Build Status](https://github.com/jweiland-net/socialservices/workflows/CI/badge.svg)

Manage social services to list them in frontend with a glossary and filter options.

## 1 Features

* Create socialservices records
* List view with pagebrowser
* Detail view

## 2 Usage

### 2.1 Installation

#### Installation using Composer

The recommended way to install the extension is using Composer.

Run the following command within your Composer based TYPO3 project:

```
composer require jweiland/socialservices
```

#### Installation as extension from TYPO3 Extension Repository (TER)

Download and install `socialservices` with the extension manager module.

### 2.2 Minimal setup

1) Include the static TypoScript of the extension.
2) Create a socialservices records on a sysfolder.
3) Assign plugin "socialservices" on a page and select at least the sysfolder as startingpoint.

## 3 Support

Free Support is available via [Github Issue Tracker](https://github.com/jweiland-net/socialservices/issues).

For commercial support, please contact us at [support@jweiland.net](support@jweiland.net).

<!-- MARKDOWN LINKS & IMAGES -->

[extension-build-shield]: https://poser.pugx.org/jweiland/socialservices/v/stable.svg?style=for-the-badge

[extension-downloads-badge]: https://poser.pugx.org/jweiland/socialservices/d/total.svg?style=for-the-badge

[extension-monthly-downloads]: https://poser.pugx.org/jweiland/socialservices/d/monthly?style=for-the-badge

[extension-ter-url]: https://extensions.typo3.org/extension/socialservices/

[extension-packagist-url]: https://packagist.org/packages/jweiland/socialservices/

[packagist-logo-stable]: https://img.shields.io/badge/--grey.svg?style=for-the-badge&logo=packagist&logoColor=white

[TYPO3-13-url]: https://get.typo3.org/version/13

[TYPO3-shield]: https://img.shields.io/badge/TYPO3-13.4-green.svg?style=for-the-badge&logo=typo3
