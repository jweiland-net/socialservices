<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'JWeiland.' . $_EXTKEY,
	'Socialservices',
	array(
		'Helpdesk' => 'list, show, search',
		
	),
	// non-cacheable actions
	array(
		'Helpdesk' => 'search',
		
	)
);

// use hook to automatically add a map record to current yellow page
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_tcemain.php']['processDatamapClass'][] = 'JWeiland\\Socialservices\\Tca\\CreateMap';