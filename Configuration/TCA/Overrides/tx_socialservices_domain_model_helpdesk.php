<?php
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use JWeiland\Maps2\Tca\Maps2Registry;
if (!defined('TYPO3')) {
    die('Access denied.');
}

// Add categories field to helpdesk table
ExtensionManagementUtility::makeCategorizable(
    'socialservices',
    'tx_socialservices_domain_model_helpdesk',
    'categories',
    [
        'exclude' => 1,
    ]
);

// Add tx_maps2_uid column to helpdesk table
if (ExtensionManagementUtility::isLoaded('maps2')) {
    Maps2Registry::getInstance()->add(
        'socialservices',
        'tx_socialservices_domain_model_helpdesk',
        [
            'addressColumns' => ['street', 'house_number', 'zip', 'city'],
            'defaultCountry' => 'Deutschland',
            'defaultStoragePid' => [
                'extKey' => 'socialservices',
                'property' => 'poiCollectionPid',
            ],
            'synchronizeColumns' => [
                [
                    'foreignColumnName' => 'title',
                    'poiCollectionColumnName' => 'title',
                ],
            ],
        ]
    );
}
