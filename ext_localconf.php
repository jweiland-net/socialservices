<?php
if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

call_user_func(function () {
    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
        'JWeiland.socialservices',
        'Socialservices',
        ['Helpdesk' => 'list, show, search'],
        // non-cacheable actions
        ['Helpdesk' => 'search']
    );

    // Register SVG Icon Identifier
    $svgIcons = [
        'ext-socialservices-socialservices-wizard-icon' => 'plugin_wizard.svg',
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

    // add socialservices plugin to new element wizard
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig(
        '<INCLUDE_TYPOSCRIPT: source="FILE:EXT:socialservices/Configuration/TSconfig/ContentElementWizard.txt">'
    );
});
