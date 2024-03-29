<?php

declare (strict_types = 1);
defined('TYPO3') or die();

// Adds the content element to the "Type" dropdown
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTcaSelectItem(
    'tt_content',
    'CType',
    [
        // title
        'HTML Table',
        // 'LLL:EXT:htmltables/Resources/Private/Language/locallang.xlf:htmltables_htmltable_title',
        // plugin signature: extkey_identifier
        'htmltables_htmltable',
        // icon identifier
        'content-text',
    ],
    'textmedia',
    'after'
);

$temporaryColumn = [
    'table_summary' => [
        'label' => 'summary',
        'config' => [
            'type' => 'input',
            'size' => 30,
            'max' => 255,
            'required' => false,
            'eval' => 'trim',
        ],
    ],
    'htmltables_row' => [
        'exclude' => 0,
        'label' => 'LLL:EXT:htmltables/Resources/Private/Language/locallang_db.xlf:tt_content.htmltables_row',
        'config' => [
            'type'                => 'inline',
            'foreign_label'       => 'title',
            'foreign_table'       => 'tx_htmltables_table_row',
            'foreign_field'       => 'parentid',
            'foreign_table_field' => 'parenttable',
            'appearance'          => [
                'expandSingle'                      => true,
                'newRecordLinkTitle'                => 'Add table row',
                'useSortable'                       => true,
                'showSynchronizationLink'           => true,
                'showAllLocalizationLink'           => true,
                'showPossibleLocalizationRecords'   => true,
                'enabledControls' => [
                    'hide' => false
                ]
            ],
        ],
    ],
];

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('tt_content', $temporaryColumn);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addFieldsToPalette('tt_content', 'captionAndSummary', 'table_caption,table_summary');

// Configure the default backend fields for the content element
$GLOBALS['TCA']['tt_content']['types']['htmltables_htmltable'] = [
    'showitem' => '
        --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,
            --palette--;;general,
            --palette--;;header,
            --palette--;;captionAndSummary,
            --palette--;;tablelayout,
            htmltables_row; Row,
        --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.appearance,
            --palette--;;frames,
            --palette--;;appearanceLinks,
        --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:language,
            --palette--;;language,
        --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access,
            --palette--;;hidden,
            --palette--;;access,
        --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:categories, categories,
        --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:notes, rowDescription,
        --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:extended,
    ',
    // 'columnsOverrides' => [
    // 'bodytext' => [
    //     'config' => [
    //         'enableRichtext' => true,
    //         'richtextConfiguration' => 'default',
    //     ],
    // ],
    // ],
];
