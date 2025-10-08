<?php

/*
 * This file is part of the package jweiland/socialservices.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

use TYPO3\CMS\Extbase\Utility\ExtensionUtility;

if (!defined('TYPO3')) {
    die('Access denied.');
}

ExtensionUtility::registerPlugin(
    'Socialservices',
    'Socialservices',
    'LLL:EXT:socialservices/Resources/Private/Language/locallang_db.xlf:plugin.title',
);
