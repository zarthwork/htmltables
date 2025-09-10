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
        $row = $params['row'];

        // set row title
        $params['title'] = $this->setRowTitle($row);

        // get cell amount & content
        $cells = $this->getCellData($row['uid']);
        $amountOfCellsRow = $this->getAmountOfCells($cells);
        $cellContentsRow = $this->getCellContents($cells);

        // get configuration of cell information display
        $extensionConfiguration = GeneralUtility::makeInstance(ExtensionConfiguration::class);
        $displayCells = $extensionConfiguration->get('htmltables', 'showCellInformation');

        // set cell data after row title
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

    /**
     * receive cell content as html-wrapped piece
     *
     * @param array $cells
     *
     * @return string
     */
    protected function getCellContents($cells)
    {
        $contentArray = array_column($cells, 'bodytext');
        $recordsArray = array_column($cells, 'records');

        // strip tags
        array_walk($contentArray, function(&$value, $key) use ($recordsArray)
        {
            $class = "htmltables-preview-cell text-truncate";
            if (!empty($value)) {
                $value = strip_tags($value);
            }
            else {
                if (empty($recordsArray[$key]))
                    $value = ' ⸺ ';
                else
                    $value = '< ' . $recordsArray[$key] .' >';

                $class .= ' cell-empty';
            }
            $value = '<span class="badge text-bg-primary text-white '.$class.'">'.$value.'</span>';

        });
        $cellContents = implode(' ', $contentArray);
        $cellContentsRow  = $cellContents?' &nbsp; <span class="mb-0 float-end" style="line-height:1.75">' . $cellContents . '</span>':'';

        return $cellContentsRow;
    }

    /**
     * get the number of cells in the row
     *
     * @param array $cells
     *
     * @return integer
     */
    protected function getAmountOfCells($cells)
    {
        $amountOfCells = count($cells);
        $amountOfCellsRow = '<span class="ms-2 badge text-bg-secondary text-black float-end">' . $amountOfCells . '</span>';
        return $amountOfCellsRow;
    }

    /**
     * returns the row title
     *
     * @param array $row
     *
     * @return string
     */
    protected function setRowTitle($row)
    {
        $contentTable = BackendUtility::getRecord($row['parenttable'], $row['parentid']);
        $isFirstHeaderRow = !empty($contentTable['table_header_position']) && $contentTable['table_header_position'] === 1 ? true : false;
        $isLastFooterRow = !empty($contentTable['table_tfoot']) && $contentTable['table_tfoot'] === 1 ? true : false;

        // set title with preceding nr. (1. Row)
        if (!empty($row['title']))
            $title = $row['title'];
        else if (!empty($row['sorting']))
            $title = $row['sorting'].'. Row';
        else
            $title = '<i>NEW Row</i>';

        // set [Header] or [Footer]
        $rowIndex = $this->getRowIndices($row['parentid']);
        if (is_array($rowIndex)) {
            if ($isFirstHeaderRow && $rowIndex['isFirst'] === $row['uid'])
                $title .= ' [Header]';

            if ($isLastFooterRow && $rowIndex['isLast'] === $row['uid'] && $rowIndex['total'] > 2)
                $title .= ' [Footer]';
        }

        return $title;
    }

    /**
     * return row indices
     *
     * @param integer $contentUid
     *
     * @return array  row indices
     */
    protected function getRowIndices($contentUid)
    {
        $table = 'tx_htmltables_table_row';
        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable($table);
        $result = $queryBuilder
            ->select('uid', 'sorting')
            ->from($table)
            ->where(
                $queryBuilder->expr()->eq('parentid', $queryBuilder->createNamedParameter($contentUid, Connection::PARAM_INT))
            )
            ->orderBy('sorting')
            ->executeQuery()
            ->fetchAllAssociative();

        if (!empty($result)) {
            $index = [
                'isFirst'   => current($result)['uid'],
                'total'     => count($result),
                'isLast'    => end($result)['uid']
            ];
            return $index;
        }
        else {
            return false;
        }

    }

    /**
     * return cell data
     *
     * @param integer $rowUid
     *
     * @return array  cell data
     */
    public function getCellData($rowUid)
    {
        $table = 'tx_htmltables_table_cell';
        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable($table);
        $result = $queryBuilder
            ->select('uid', 'headercell', 'bodytext', 'records', 'colspan', 'rowspan')
            ->from($table)
            ->where(
                $queryBuilder->expr()->eq('parentid', $queryBuilder->createNamedParameter($rowUid, Connection::PARAM_INT))
            )
            ->orderBy('sorting')
            ->executeQuery()
            ->fetchAllAssociative();

        return $result;
    }

    public function getRows($contentUid)
    {
        $table = 'tx_htmltables_table_row';
        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable($table);
        $result = $queryBuilder
            ->select('uid', 'sorting')
            ->from($table)
            ->where(
                $queryBuilder->expr()->eq('parentid', $queryBuilder->createNamedParameter($contentUid, Connection::PARAM_INT))
            )
            ->orderBy('sorting')
            ->executeQuery()
            ->fetchAllAssociative();

        if (!empty($result)) {
            return $result;
        }
        else {
            return false;
        }
    }
}
