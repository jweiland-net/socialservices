<?php
return [
    'ctrl' => [
        'title' => 'LLL:EXT:socialservices/Resources/Private/Language/locallang_db.xlf:tx_socialservices_domain_model_helpdesk',
        'label' => 'title',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'dividers2tabs' => true,
        'default_sortby' => 'ORDER BY title',

        'versioningWS' => 2,
        'versioning_followPages' => true,
        'origUid' => 't3_origuid',
        'languageField' => 'sys_language_uid',
        'transOrigPointerField' => 'l10n_parent',
        'transOrigDiffSourceField' => 'l10n_diffsource',
        'delete' => 'deleted',
        'enablecolumns' => [
            'disabled' => 'hidden',
            'starttime' => 'starttime',
            'endtime' => 'endtime',
        ],
        'searchFields' => 'title,street,zip,city,telephone,fax,contact_person,email,website,description,tags,district,',
        'iconfile' => 'EXT:socialservices/Resources/Public/Icons/tx_socialservices_domain_model_helpdesk.gif'
    ],
    'interface' => [
        'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, title, street, house_number, zip, city, district, telephone, fax, contact_person, contact_times, email, website, barrier_free, description, tx_maps2_uid, facebook, twitter, google, tags',
    ],
    'types' => [
        '1' => ['showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, title, street, house_number, zip, city, district, telephone, fax, contact_person, contact_times, email, website, barrier_free, description, tx_maps2_uid, facebook, twitter, google, tags,--div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access,starttime, endtime'],
    ],
    'palettes' => [
        '1' => ['showitem' => ''],
    ],
    'columns' => [
        'sys_language_uid' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.language',
            'config' => [
                'type' => 'select',
                'foreign_table' => 'sys_language',
                'foreign_table_where' => 'ORDER BY sys_language.title',
                'items' => [
                    ['LLL:EXT:lang/locallang_general.xlf:LGL.allLanguages', -1],
                    ['LLL:EXT:lang/locallang_general.xlf:LGL.default_value', 0]
                ],
            ],
        ],
        'l10n_parent' => [
            'displayCond' => 'FIELD:sys_language_uid:>:0',
            'exclude' => 1,
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.l18n_parent',
            'config' => [
                'type' => 'select',
                'items' => [
                    ['', 0],
                ],
                'foreign_table' => 'tx_socialservices_domain_model_helpdesk',
                'foreign_table_where' => 'AND tx_socialservices_domain_model_helpdesk.pid=###CURRENT_PID### AND tx_socialservices_domain_model_helpdesk.sys_language_uid IN (-1,0)',
            ],
        ],
        'l10n_diffsource' => [
            'config' => [
                'type' => 'passthrough',
            ],
        ],
        't3ver_label' => [
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.versionLabel',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'max' => 255,
            ]
        ],
        'hidden' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.hidden',
            'config' => [
                'type' => 'check',
            ],
        ],
        'starttime' => [
            'exclude' => 1,
            'l10n_mode' => 'mergeIfNotBlank',
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.starttime',
            'config' => [
                'type' => 'input',
                'size' => 13,
                'max' => 20,
                'eval' => 'datetime',
                'checkbox' => 0,
                'default' => 0,
                'range' => [
                    'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
                ],
            ],
        ],
        'endtime' => [
            'exclude' => 1,
            'l10n_mode' => 'mergeIfNotBlank',
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.endtime',
            'config' => [
                'type' => 'input',
                'size' => 13,
                'max' => 20,
                'eval' => 'datetime',
                'checkbox' => 0,
                'default' => 0,
                'range' => [
                    'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
                ],
            ],
        ],
        'title' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:socialservices/Resources/Private/Language/locallang_db.xlf:tx_socialservices_domain_model_helpdesk.title',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim,required'
            ],
        ],
        'street' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:socialservices/Resources/Private/Language/locallang_db.xlf:tx_socialservices_domain_model_helpdesk.street',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'house_number' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:socialservices/Resources/Private/Language/locallang_db.xlf:tx_socialservices_domain_model_helpdesk.houseNumber',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'zip' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:socialservices/Resources/Private/Language/locallang_db.xlf:tx_socialservices_domain_model_helpdesk.zip',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'city' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:socialservices/Resources/Private/Language/locallang_db.xlf:tx_socialservices_domain_model_helpdesk.city',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'district' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:socialservices/Resources/Private/Language/locallang_db.xlf:tx_socialservices_domain_model_helpdesk.district',
            'config' => [
                'type' => 'select',
                'foreign_table' => 'tx_socialservices_domain_model_district',
                'foreign_table_where' => 'ORDER BY tx_socialservices_domain_model_district.district',
                'items' => [
                    ['', ''],
                ],
                'minitems' => 0,
                'maxitems' => 1,
            ],
        ],
        'telephone' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:socialservices/Resources/Private/Language/locallang_db.xlf:tx_socialservices_domain_model_helpdesk.telephone',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'fax' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:socialservices/Resources/Private/Language/locallang_db.xlf:tx_socialservices_domain_model_helpdesk.fax',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'contact_person' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:socialservices/Resources/Private/Language/locallang_db.xlf:tx_socialservices_domain_model_helpdesk.contactPerson',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'contact_times' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:socialservices/Resources/Private/Language/locallang_db.xlf:tx_socialservices_domain_model_helpdesk.contactTimes',
            'config' => [
                'type' => 'text',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'email' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:socialservices/Resources/Private/Language/locallang_db.xlf:tx_socialservices_domain_model_helpdesk.email',
            'config' => [
                'type' => 'input',
                'cols' => 30,
                'rows' => '10',
                'wrap' => 'off',
            ],
        ],
        'website' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:socialservices/Resources/Private/Language/locallang_db.xlf:tx_socialservices_domain_model_helpdesk.website',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim',
                'wizards' => [
                    '_PADDING' => 2,
                    'link' => [
                        'type' => 'popup',
                        'title' => 'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:header_link_formlabel',
                        'icon' => 'actions-wizard-link',
                        'module' => [
                            'name' => 'wizard_link',
                        ],
                        'JSopenParams' => 'height=300,width=500,status=0,menubar=0,scrollbars=1'
                    ],
                ],
                'softref' => 'typolink'
            ],
        ],
        'barrier_free' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:socialservices/Resources/Private/Language/locallang_db.xlf:tx_socialservices_domain_model_helpdesk.barrierFree',
            'config' => [
                'type' => 'check',
                'default' => 0,
            ],
        ],
        'description' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:socialservices/Resources/Private/Language/locallang_db.xlf:tx_socialservices_domain_model_helpdesk.description',
            'config' => [
                'type' => 'text',
                'cols' => 40,
                'rows' => 15,
                'eval' => 'trim',
                'wizards' => [
                    '_PADDING' => 2,
                    'RTE' => [
                        'notNewRecords' => 1,
                        'RTEonly' => 1,
                        'type' => 'script',
                        'title' => 'Full screen Rich Text Editing',
                        'icon' => 'wizard_rte2.gif',
                        'module' => [
                            'name' => 'wizard_rte',
                        ],
                    ],
                ],
            ],
            'defaultExtras' => 'richtext:rte_transform[flag=rte_enabled|mode=ts]',
        ],
        'facebook' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:socialservices/Resources/Private/Language/locallang_db.xlf:tx_socialservices_domain_model_helpdesk.facebook',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim',
            ],
        ],
        'twitter' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:socialservices/Resources/Private/Language/locallang_db.xlf:tx_socialservices_domain_model_helpdesk.twitter',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim',
            ],
        ],
        'google' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:socialservices/Resources/Private/Language/locallang_db.xlf:tx_socialservices_domain_model_helpdesk.google',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim',
            ],
        ],
        'tags' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:socialservices/Resources/Private/Language/locallang_db.xlf:tx_socialservices_domain_model_helpdesk.tags',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'tx_maps2_uid' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:socialservices/Resources/Private/Language/locallang_db.xlf:tx_socialservices_domain_model_helpdesk.txMaps2Uid',
            'config' => [
                'type' => 'group',
                'internal_type' => 'db',
                'allowed' => 'tx_maps2_domain_model_poicollection',
                'prepend_tname' => false,
                'show_thumbs' => false,
                'size' => 1,
                'maxitems' => 1,
                'wizards' => [
                    'suggest' => [
                        'type' => 'suggest',
                        'default' => [
                            'searchWholePhrase' => true
                        ],
                    ],
                ],
            ],
        ],
    ],
];
