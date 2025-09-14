<?php

if (!defined('TYPO3')) {
    die('Access denied.');
}

use JWeiland\Socialservices\Controller\HelpdeskController;
use JWeiland\Socialservices\Updater\Socialservices2SlugUpdater;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Extbase\Utility\ExtensionUtility;

call_user_func(static function () {
    ExtensionUtility::configurePlugin(
        'Socialservices',
        'Socialservices',
        [
            HelpdeskController::class => 'list, show, search',
        ],
        // non-cacheable actions
        [
            HelpdeskController::class => 'search',
        ]
    );

    // Add socialservices plugin to new element wizard
    ExtensionManagementUtility::addPageTSConfig(
        '<INCLUDE_TYPOSCRIPT: source="FILE:EXT:socialservices/Configuration/TSconfig/ContentElementWizard.tsconfig">'
    );

    $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['ext/install']['update']['socialservicesUpdateSlug']
        = Socialservices2SlugUpdater::class;
});
