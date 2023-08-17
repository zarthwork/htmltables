<?php
declare(strict_types=1);

use TYPO3\CMS\Core\Information\Typo3Version;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;

defined('TYPO3') or die();

$GLOBALS['TYPO3_CONF_VARS']['RTE']['Presets']['htmltables'] = 'EXT:htmltables/Configuration/RTE/Htmltables.yaml';

// condition for version 11
$versionInformation = GeneralUtility::makeInstance(Typo3Version::class);
if ($versionInformation->getMajorVersion() < 12) {

    ExtensionManagementUtility::addPageTSConfig(
        '@import "EXT:htmltables/Configuration/page.tsconfig"'
    );

    $GLOBALS['TYPO3_CONF_VARS']['RTE']['Presets']['htmltables'] = 'EXT:htmltables/Configuration/RTE/Htmltables_v11.yaml';
}
