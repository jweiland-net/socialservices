<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

$TCA['tx_socialservices_domain_model_helpdesk'] = array(
	'ctrl' => $TCA['tx_socialservices_domain_model_helpdesk']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, title, street, house_number, zip, city, district, telephone, fax, contact_person, contact_times, email, website, barrier_free, description, tx_maps2_uid, facebook, twitter, google, tags',
	),
	'types' => array(
		'1' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, title, street, house_number, zip, city, district, telephone, fax, contact_person, contact_times, email, website, barrier_free, description, tx_maps2_uid, facebook, twitter, google, tags,--div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access,starttime, endtime'),
	),
	'palettes' => array(
		'1' => array('showitem' => ''),
	),
	'columns' => array(
		'sys_language_uid' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.language',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'sys_language',
				'foreign_table_where' => 'ORDER BY sys_language.title',
				'items' => array(
					array('LLL:EXT:lang/locallang_general.xlf:LGL.allLanguages', -1),
					array('LLL:EXT:lang/locallang_general.xlf:LGL.default_value', 0)
				),
			),
		),
		'l10n_parent' => array(
			'displayCond' => 'FIELD:sys_language_uid:>:0',
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.l18n_parent',
			'config' => array(
				'type' => 'select',
				'items' => array(
					array('', 0),
				),
				'foreign_table' => 'tx_socialservices_domain_model_helpdesk',
				'foreign_table_where' => 'AND tx_socialservices_domain_model_helpdesk.pid=###CURRENT_PID### AND tx_socialservices_domain_model_helpdesk.sys_language_uid IN (-1,0)',
			),
		),
		'l10n_diffsource' => array(
			'config' => array(
				'type' => 'passthrough',
			),
		),
		't3ver_label' => array(
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.versionLabel',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'max' => 255,
			)
		),
		'hidden' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.hidden',
			'config' => array(
				'type' => 'check',
			),
		),
		'starttime' => array(
			'exclude' => 1,
			'l10n_mode' => 'mergeIfNotBlank',
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.starttime',
			'config' => array(
				'type' => 'input',
				'size' => 13,
				'max' => 20,
				'eval' => 'datetime',
				'checkbox' => 0,
				'default' => 0,
				'range' => array(
					'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
				),
			),
		),
		'endtime' => array(
			'exclude' => 1,
			'l10n_mode' => 'mergeIfNotBlank',
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.endtime',
			'config' => array(
				'type' => 'input',
				'size' => 13,
				'max' => 20,
				'eval' => 'datetime',
				'checkbox' => 0,
				'default' => 0,
				'range' => array(
					'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
				),
			),
		),
		'title' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:socialservices/Resources/Private/Language/locallang_db.xlf:tx_socialservices_domain_model_helpdesk.title',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim,required'
			),
		),
		'street' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:socialservices/Resources/Private/Language/locallang_db.xlf:tx_socialservices_domain_model_helpdesk.street',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'house_number' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:socialservices/Resources/Private/Language/locallang_db.xlf:tx_socialservices_domain_model_helpdesk.houseNumber',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'zip' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:socialservices/Resources/Private/Language/locallang_db.xlf:tx_socialservices_domain_model_helpdesk.zip',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'city' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:socialservices/Resources/Private/Language/locallang_db.xlf:tx_socialservices_domain_model_helpdesk.city',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'district' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:socialservices/Resources/Private/Language/locallang_db.xlf:tx_socialservices_domain_model_helpdesk.district',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'tx_socialservices_domain_model_district',
				'foreign_table_where' => 'ORDER BY tx_socialservices_domain_model_district.district',
				'items' => array(
					array('', ''),
				),
				'minitems' => 0,
				'maxitems' => 1,
			),
		),
		'telephone' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:socialservices/Resources/Private/Language/locallang_db.xlf:tx_socialservices_domain_model_helpdesk.telephone',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'fax' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:socialservices/Resources/Private/Language/locallang_db.xlf:tx_socialservices_domain_model_helpdesk.fax',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'contact_person' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:socialservices/Resources/Private/Language/locallang_db.xlf:tx_socialservices_domain_model_helpdesk.contactPerson',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'contact_times' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:socialservices/Resources/Private/Language/locallang_db.xlf:tx_socialservices_domain_model_helpdesk.contactTimes',
			'config' => array(
				'type' => 'text',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'email' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:socialservices/Resources/Private/Language/locallang_db.xlf:tx_socialservices_domain_model_helpdesk.email',
			'config' => array(
				'type' => 'input',
				'cols' => 30,
				'rows' => '10',
				'wrap' => 'off',
			),
		),
		'website' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:socialservices/Resources/Private/Language/locallang_db.xlf:tx_socialservices_domain_model_helpdesk.website',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim',
				'wizards' => array(
					'_PADDING' => 2,
					'link' => array(
						'type' => 'popup',
						'title' => 'Link',
						'icon' => 'link_popup.gif',
						'script' => 'browse_links.php?mode=wizard',
						'JSopenParams' => 'height=300,width=500,status=0,menubar=0,scrollbars=1'
					)
				),
				'softref' => 'typolink[linkList]',
			),
		),
		'barrier_free' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:socialservices/Resources/Private/Language/locallang_db.xlf:tx_socialservices_domain_model_helpdesk.barrierFree',
			'config' => array(
				'type' => 'check',
				'default' => 0,
			),
		),
		'description' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:socialservices/Resources/Private/Language/locallang_db.xlf:tx_socialservices_domain_model_helpdesk.description',
			'config' => array(
				'type' => 'text',
				'cols' => 40,
				'rows' => 15,
				'eval' => 'trim',
				'wizards' => array(
					'RTE' => array(
						'icon' => 'wizard_rte2.gif',
						'notNewRecords'=> 1,
						'RTEonly' => 1,
						'script' => 'wizard_rte.php',
						'title' => 'LLL:EXT:cms/locallang_ttc.xlf:bodytext.W.RTE',
						'type' => 'script'
					)
				)
			),
			'defaultExtras' => 'richtext:rte_transform[flag=rte_enabled|mode=ts]',
		),
		'facebook' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:socialservices/Resources/Private/Language/locallang_db.xlf:tx_socialservices_domain_model_helpdesk.facebook',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim',
			),
		),
		'twitter' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:socialservices/Resources/Private/Language/locallang_db.xlf:tx_socialservices_domain_model_helpdesk.twitter',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim',
			),
		),
		'google' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:socialservices/Resources/Private/Language/locallang_db.xlf:tx_socialservices_domain_model_helpdesk.google',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim',
			),
		),
		'tags' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:socialservices/Resources/Private/Language/locallang_db.xlf:tx_socialservices_domain_model_helpdesk.tags',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'tx_maps2_uid' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:socialservices/Resources/Private/Language/locallang_db.xlf:tx_socialservices_domain_model_helpdesk.txMaps2Uid',
			'config' => Array (
				'type' => 'group',
				'internal_type' => 'db',
				'allowed' => 'tx_maps2_domain_model_poicollection',
				'prepend_tname' => FALSE,
				'show_thumbs' => FALSE,
				'size' => 1,
				'maxitems' => 1,
				'wizards' => array(
					'suggest' => array(
						'type' => 'suggest',
						'default' => array(
							'searchWholePhrase' => TRUE
						),
					),
				),
			),
		),
	),
);