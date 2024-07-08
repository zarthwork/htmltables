<?php

/*
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */

namespace Zarth\Htmltables\Service;

use TYPO3\CMS\Backend\Utility\BackendUtility;
use TYPO3\CMS\Core\Authentication\BackendUserAuthentication;
use TYPO3\CMS\Core\Resource\Exception\InvalidUidException;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Database\Connection;
use TYPO3\CMS\Core\Text\TextCropper;
use TYPO3\CMS\Core\Configuration\ExtensionConfiguration;

/**
 * inline label service
 *
 */
class InlineLabelService
{
    /**
     * Get the user function label for the file_reference table
     */
    public function getInlineLabel(array &$params)
    {
        if (empty($params['row']['title']))
            $params['title'] = $params['row']['sorting']?$params['row']['sorting'].'. Row':'Row';
        else
            $params['title'] = $params['row']['title'];

        // fetch associated cell contents 
        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('tx_htmltables_table_cell');
        $result = $queryBuilder
            ->select('uid', 'headercell', 'bodytext')
            ->from('tx_htmltables_table_cell')
            ->where(
                $queryBuilder->expr()->eq('parentid', $queryBuilder->createNamedParameter($params['row']['uid'], Connection::PARAM_INT))
            )
            ->executeQuery()
            ->fetchAllAssociative();

        $amountOfCells = count($result);

        $contentArray = array_column($result, 'bodytext');

        // strip tags
        array_walk($contentArray, function(&$value) 
        { 
            if (!empty($value)) {
                $value = strip_tags($value);
                $class = "cell text-truncate";
            }
            else {
                $value = ' ⸺ ';
                $class = 'cell cell-empty text-truncate';
            }
            $value = '<span class="badge text-bg-primary '.$class.'">'.$value.'</span>';

        });
        $cellContents = implode(' ', $contentArray);

        // $contentArray = array_filter($contentArray);
        // $contentString = implode(' | ', $contentArray);
        // $cellContents = strip_tags($contentString);
        // $cellContents = GeneralUtility::makeInstance(TextCropper::class)->crop(
        //     content: $cellContents,
        //     numberOfChars: 100,
        //     replacementForEllipsis: '…',
        //     cropToSpace: true
        // );

        $amountOfCellsRow = '<span class="ms-2 badge text-bg-primary float-end">' . $amountOfCells . ' cells</span>';
        $cellContentsRow  = $cellContents?' &nbsp; <pre class="mb-0 float-end" style="line-height:1.75">' . $cellContents . '</pre>':'';

        // get configuration of cell information display in rows
        $extensionConfiguration = GeneralUtility::makeInstance(ExtensionConfiguration::class);
        $displayCells = $extensionConfiguration->get('htmltables', 'showCellInformation');
        switch ($displayCells) {
            case '1':
                $params['title'] .= $amountOfCellsRow;
                break;
            
            case '2':
                $params['title'] .= $cellContentsRow;
                break;

            case '3':
                $params['title'] .= $amountOfCellsRow . $cellContentsRow;
                break;

            default:
                break;
        }
        return;
    }
}
