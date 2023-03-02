# TYPO3 Extension `socialservices`

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
