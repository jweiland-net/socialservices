<?php
return [
    'ctrl' => [
        'title' => 'LLL:EXT:socialservices/Resources/Private/Language/locallang_db.xlf:tx_socialservices_domain_model_helpdesk',
        'label' => 'title',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'default_sortby' => 'ORDER BY title',
        'versioningWS' => true,
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
        'iconfile' => 'EXT:socialservices/Resources/Public/Icons/tx_socialservices_domain_model_helpdesk.svg'
    ],
    'types' => [
        '1' => [
            'showitem' => '--palette--;;languageHidden, title, path_segment,
            --palette--;;streetHouseNumber, --palette--;;zipCity, --palette--;;districtBarrierFree,
            --palette--;;contact, --palette--;;telephoneFax, --palette--;;emailWebsite, 
            description, facebook, twitter, instagram, tags,
            --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_tca.xlf:pages.tabs.access, 
            --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_tca.xlf:pages.palettes.access;access'
        ],
    ],
    'palettes' => [
        'languageHidden' => ['showitem' => 'sys_language_uid, l10n_parent, hidden'],
        'streetHouseNumber' => ['showitem' => 'street, house_number'],
        'zipCity' => ['showitem' => 'zip, city'],
        'districtBarrierFree' => ['showitem' => 'district, barrier_free'],
        'contact' => ['showitem' => 'contact_person, contact_times'],
        'telephoneFax' => ['showitem' => 'telephone, fax'],
        'emailWebsite' => ['showitem' => 'email, website'],
        'access' => [
            'showitem' => 'starttime;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:starttime_formlabel,endtime;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:endtime_formlabel',
        ]
    ],
    'columns' => [
        'sys_language_uid' => [
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.language',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'special' => 'languages',
                'items' => [
                    [
                        'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.allLanguages',
                        -1,
                        'flags-multiple'
                    ],
                ],
                'default' => 0,
            ]
        ],
        'l10n_parent' => [
            'displayCond' => 'FIELD:sys_language_uid:>:0',
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.l18n_parent',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    ['', 0],
                ],
                'foreign_table' => 'tx_socialservices_domain_model_helpdesk',
                'foreign_table_where' => 'AND tx_socialservices_domain_model_helpdesk.pid=###CURRENT_PID### AND tx_socialservices_domain_model_helpdesk.sys_language_uid IN (-1,0)',
                'fieldWizard' => [
                    'selectIcons' => [
                        'disabled' => true,
                    ],
                ],
                'default' => 0,
            ]
        ],
        'l10n_diffsource' => [
            'config' => [
                'type' => 'passthrough',
                'default' => ''
            ]
        ],
        'hidden' => [
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.hidden',
            'config' => [
                'type' => 'check',
                'default' => 0
            ]
        ],
        'cruser_id' => [
            'label' => 'cruser_id',
            'config' => [
                'type' => 'passthrough'
            ]
        ],
        'pid' => [
            'label' => 'pid',
            'config' => [
                'type' => 'passthrough'
            ]
        ],
        'crdate' => [
            'label' => 'crdate',
            'config' => [
                'type' => 'passthrough',
            ]
        ],
        'tstamp' => [
            'label' => 'tstamp',
            'config' => [
                'type' => 'passthrough',
            ]
        ],
        'starttime' => [
            'exclude' => true,
            'label' => 'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:starttime_formlabel',
            'config' => [
                'type' => 'input',
                'renderType' => 'inputDateTime',
                'size' => 16,
                'eval' => 'datetime,int',
                'default' => 0,
                'behaviour' => [
                    'allowLanguageSynchronization' => true,
                ],
            ]
        ],
        'endtime' => [
            'exclude' => true,
            'label' => 'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:endtime_formlabel',
            'config' => [
                'type' => 'input',
                'renderType' => 'inputDateTime',
                'size' => 16,
                'eval' => 'datetime,int',
                'default' => 0,
                'behaviour' => [
                    'allowLanguageSynchronization' => true,
                ],
            ]
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
        'path_segment' => [
            'label' => 'LLL:EXT:socialservices/Resources/Private/Language/locallang_db.xlf:tx_socialservices_domain_model_helpdesk.path_segment',
            'displayCond' => 'VERSION:IS:false',
            'config' => [
                'type' => 'slug',
                'size' => 50,
                'generatorOptions' => [
                    'fields' => ['title'],
                    // Do not add pageSlug, as we add pageSlug on our own in RouteEnhancer
                    'prefixParentPageSlug' => false,
                    'fieldSeparator' => '-',
                    'replacements' => [
                        '/' => '-'
                    ],
                ],
                'fallbackCharacter' => '-',
                'eval' => 'unique',
                'default' => ''
            ]
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
                'renderType' => 'selectSingle',
                'foreign_table' => 'tx_socialservices_domain_model_district',
                'foreign_table_where' => 'ORDER BY tx_socialservices_domain_model_district.district',
                'items' => [
                    ['', ''],
                ],
                'minitems' => 1,
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
                'rows' => 10,
                'wrap' => 'off',
            ],
        ],
        'website' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:socialservices/Resources/Private/Language/locallang_db.xlf:tx_socialservices_domain_model_helpdesk.website',
            'config' => [
                'type' => 'input',
                'renderType' => 'inputLink',
                'size' => 50,
                'max' => 1024,
                'eval' => 'trim',
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
                'softref' => 'typolink_tag,images,email[subst],url',
                'enableRichtext' => true,
            ],
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
        'instagram' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:socialservices/Resources/Private/Language/locallang_db.xlf:tx_socialservices_domain_model_helpdesk.instagram',
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
    ],
];
