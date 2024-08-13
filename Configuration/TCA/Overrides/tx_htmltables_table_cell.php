<?php
declare (strict_types = 1);

use TYPO3\CMS\Core\Information\Typo3Version;
use TYPO3\CMS\Core\Utility\GeneralUtility;

defined('TYPO3') or die();

// condition for v11
$versionInformation = GeneralUtility::makeInstance(Typo3Version::class);
if ($versionInformation->getMajorVersion() < 12) {

    // 'items' was rendered differently in version 11
    $GLOBALS['TCA']['tx_htmltables_table_cell']['columns']['scope']['config']['items'] = [
        [
            'none', ''
        ],
        [
            'row', 'row'
        ],
        [
            'col', 'col'
        ],
        [
            'rowgroup', 'rowgroup'
        ],
        [
            'colgroup', 'colgroup'
        ],
        [
            'auto', 'auto'
        ]
    ];
}
