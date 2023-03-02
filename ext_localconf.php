<?php
if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

call_user_func(static function () {
    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
        'Socialservices',
        'Socialservices',
        [
            \JWeiland\Socialservices\Controller\HelpdeskController::class => 'list, show, search',
        ],
        // non-cacheable actions
        [
            \JWeiland\Socialservices\Controller\HelpdeskController::class => 'search',
        ]
    );

    // Register SVG Icon Identifier
    $svgIcons = [
        'ext-socialservices-wizard-icon' => 'Extension.svg',
    ];
    $iconRegistry = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(
        \TYPO3\CMS\Core\Imaging\IconRegistry::class
    );
    foreach ($svgIcons as $identifier => $fileName) {
        $iconRegistry->registerIcon(
            $identifier,
            \TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
            ['source' => 'EXT:socialservices/Resources/Public/Icons/' . $fileName]
        );
    }

    // Add socialservices plugin to new element wizard
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig(
        '<INCLUDE_TYPOSCRIPT: source="FILE:EXT:socialservices/Configuration/TSconfig/ContentElementWizard.tsconfig">'
    );

    $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['ext/install']['update']['socialservicesUpdateSlug']
        = \JWeiland\Socialservices\Updater\Socialservices2SlugUpdater::class;
});
