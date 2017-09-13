<?php
// add categories field to helpdesk table
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::makeCategorizable(
    'socialservices',
    'tx_socialservices_domain_model_helpdesk',
    'categories',
    [
        'exclude' => 1
    ]
);
