<?php
if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    'JWeiland.socialservices',
    'Socialservices',
    'LLL:EXT:socialservices/Resources/Private/Language/locallang_db.xlf:plugin.title'
);
