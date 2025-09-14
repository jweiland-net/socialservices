<?php
use TYPO3\CMS\Extbase\Utility\ExtensionUtility;
if (!defined('TYPO3')) {
    die('Access denied.');
}

ExtensionUtility::registerPlugin(
    'Socialservices',
    'Socialservices',
    'LLL:EXT:socialservices/Resources/Private/Language/locallang_db.xlf:plugin.title'
);
