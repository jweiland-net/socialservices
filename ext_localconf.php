<?php
if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'JWeiland.socialservices',
    'Socialservices',
    ['Helpdesk' => 'list, show, search'],
    // non-cacheable actions
    ['Helpdesk' => 'search']
);
