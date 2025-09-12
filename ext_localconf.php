<?php
declare(strict_types=1);

use TYPO3\CMS\Core\Information\Typo3Version;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Core\Configuration\ExtensionConfiguration;
use TYPO3\CMS\Core\Utility\GeneralUtility;

defined('TYPO3') or die();

(function($extKey)
{
    // v12 & v13 
    $GLOBALS['TYPO3_CONF_VARS']['RTE']['Presets'][$extKey] = 'EXT:'.$extKey.'/Configuration/RTE/Htmltables.yaml';

    $extensionConfiguration = GeneralUtility::makeInstance(ExtensionConfiguration::class);
    $extensionConf = $extensionConfiguration->get('htmltables');

    // Add TypoScript Setup (useResponsiveTable, useBootstrapTableClass)
    ExtensionManagementUtility::addTypoScriptSetup(
        'plugin.'.$extKey.'.settings.useResponsiveTable = ' . $extensionConf['useResponsiveTable'] ?? 0 . '
         plugin.'.$extKey.'.settings.useBootstrapTableClass = ' . $extensionConf['useBootstrapTableClass'] ?? 0
    );

    // condition for v11
    $versionInformation = GeneralUtility::makeInstance(Typo3Version::class);
    if ($versionInformation->getMajorVersion() < 12) {
        ExtensionManagementUtility::addPageTSConfig(
            '@import "EXT:'.$extKey.'/Configuration/page.tsconfig"'
        );
        $GLOBALS['TYPO3_CONF_VARS']['RTE']['Presets'][$extKey] = 'EXT:'.$extKey.'/Configuration/RTE/Htmltables_v11.yaml';
    }

    // backend css
    $GLOBALS['TYPO3_CONF_VARS']['BE']['stylesheets'][$extKey] = 'EXT:'.$extKey.'/Resources/Public/Backend/Css/';

})('htmltables');
