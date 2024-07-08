<?php
declare(strict_types=1);

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Core\Information\Typo3Version;
use TYPO3\CMS\Core\Utility\GeneralUtility;

defined('TYPO3') or die();

// condition for versions below 13
$versionInformation = GeneralUtility::makeInstance(Typo3Version::class);
if ($versionInformation->getMajorVersion() < 12) {
	ExtensionManagementUtility::allowTableOnStandardPages('tx_htmltables_table_row');
	ExtensionManagementUtility::allowTableOnStandardPages('tx_htmltables_table_cell');
}