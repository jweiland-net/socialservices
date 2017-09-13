<?php
if (!defined('TYPO3_MODE')) {
    die ('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'JWeiland.' . $_EXTKEY,
    'Socialservices',
    ['Helpdesk' => 'list, show, search'],
    // non-cacheable actions
    ['Helpdesk' => 'search']
);

// use hook to automatically add a map record to current yellow page
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_tcemain.php']['processDatamapClass'][] = \JWeiland\Socialservices\Tca\CreateMap::class;

$extConf = unserialize($_EXTCONF);
$tsConfig = 'ext.socialservices.pid = ' . (int)$extConf['poiCollectionPid'];
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig($tsConfig);
