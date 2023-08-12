<?php

return [
    'ctrl' => [
        'title' => 'LLL:EXT:htmltables/Resources/Private/Language/locallang.xlf:table_row_title',
        'label' => 'title',
        'iconfile' => 'EXT:htmltables/Resources/Public/Icons/Row.svg',
        'security' => [
            'ignorePageTypeRestriction' => true,
        ],
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'delete' => 'deleted',
        'sortby' => 'sorting',
        'enablecolumns' => [
            'disabled' => 'hidden',
        ],
    ],
   'columns' => [
        'title' => [
            'label' => 'Title (hidden)',
            'config' => [
                'default' => 'Row',
                'type' => 'input',
                'size' => 20,
                'max' => 30,
                'required' => false,
                'eval' => 'trim',
            ],
        ],
        'htmltables_col' => [
            'exclude' => 0,
            'label' => 'LLL:EXT:htmltables/Resources/Private/Language/locallang_db.xlf:tt_content.htmltables_col',
            'config' => [
                'type'                => 'inline',
                'foreign_label'       => 'bodytext',
                'foreign_table'       => 'tx_htmltables_table_cell',
                'foreign_field'       => 'parentid',
                'foreign_table_field' => 'parenttable',
                'appearance'          => [
                    'expandSingle'                      => true,
                    'newRecordLinkTitle'                => 'Add table cell',
                    'useSortable'                       => true,
                    'showSynchronizationLink'           => true,
                    'showAllLocalizationLink'           => true,
                    'showPossibleLocalizationRecords'   => true,
                    'showPossibleRecordsSelector'       => true,
                    'enabledControls' => [
                        'info' => true,
                        'new' => false,
                        'dragdrop' => true,
                        'sort' => true,
                        'hide' => false,
                        'delete' => true,
                        'localize' => false,
                    ],
                ],
            ],
        ],
        'parentid' => [
            'label' => 'LLL:EXT:workspaces/Resources/Private/Language/locallang_db.xlf:sys_workspace_stage.parentid',
            'config' => [
                'type' => 'passthrough',
            ],
        ],
        'parenttable' => [
            'label' => 'LLL:EXT:workspaces/Resources/Private/Language/locallang_db.xlf:sys_workspace_stage.parenttable',
            'config' => [
                'type' => 'passthrough',
            ],
        ],
        'hidden' => [
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.enabled',
            'config' => [
                'type' => 'check',
                'renderType' => 'checkboxToggle',
                'default' => 0,
                'items' => [
                    [
                        'label' => '',
                        'invertStateDisplay' => true,
                    ],
                ],
            ],
        ],
    ],
    'palettes' => [
        'palette' => [
            'label' => '',
            'showitem' => 'title, hidden',
        ],
    ],
    'types' => [
        '0' => ['showitem' => '
                --palette--;;palette, htmltables_col,
        '],
    ],
];
