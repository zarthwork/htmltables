<?php
declare(strict_types=1);

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

defined('TYPO3') or die();

ExtensionManagementUtility::allowTableOnStandardPages('tx_htmltables_table_row');
ExtensionManagementUtility::allowTableOnStandardPages('tx_htmltables_table_cell');