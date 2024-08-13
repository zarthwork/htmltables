<?php
declare(strict_types=1);

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Core\Information\Typo3Version;
use TYPO3\CMS\Core\Utility\GeneralUtility;

defined('TYPO3') or die();

// condition for v11
$versionInformation = GeneralUtility::makeInstance(Typo3Version::class);
if ($versionInformation->getMajorVersion() < 12) {
    ExtensionManagementUtility::allowTableOnStandardPages('tx_htmltables_table_row');
    ExtensionManagementUtility::allowTableOnStandardPages('tx_htmltables_table_cell');

    // add backend css for v11
    $GLOBALS['TBE_STYLES']['skins']['htmltables']['name'] = 'htmltables';
    $GLOBALS['TBE_STYLES']['skins']['htmltables']['stylesheetDirectories'] = ['css' => 'EXT:htmltables/Resources/Public/Backend/Css/'];
}
