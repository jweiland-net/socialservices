<?php

/*
 * This file is part of the package jweiland/socialservices.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

if (!defined('TYPO3')) {
    die('Access denied.');
}

use JWeiland\Socialservices\Controller\HelpdeskController;
use JWeiland\Socialservices\Updater\Socialservices2SlugUpdater;
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
        ],
        ExtensionUtility::PLUGIN_TYPE_CONTENT_ELEMENT,
    );

    $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['ext/install']['update']['socialservicesUpdateSlug']
        = Socialservices2SlugUpdater::class;
});
