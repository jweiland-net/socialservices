<?php
if (!defined('TYPO3_MODE')) {
    die ('Access denied.');
}

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr(
    'tx_socialservices_domain_model_helpdesk',
    'EXT:socialservices/Resources/Private/Language/locallang_csh_tx_socialservices_domain_model_helpdesk.xlf'
);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr(
    'tx_socialservices_domain_model_district',
    'EXT:socialservices/Resources/Private/Language/locallang_csh_tx_socialservices_domain_model_district.xlf'
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_socialservices_domain_model_helpdesk');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_socialservices_domain_model_district');
