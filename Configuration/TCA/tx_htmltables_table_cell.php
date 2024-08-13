<?php

return [
    'ctrl' => [
        'title' => 'LLL:EXT:htmltables/Resources/Private/Language/locallang.xlf:table_row_title',
        'label' => 'bodytext',
        'iconfile' => 'EXT:htmltables/Resources/Public/Icons/Cell.svg',
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
        'transOrigPointerField' => 'l10n_parent',
        'transOrigDiffSourceField' => 'l10n_diffsource',
        'languageField' => 'sys_language_uid',
        'translationSource' => 'l10n_source',
    ],
   'columns' => [
        'title' => [
            'label' => 'Title (hidden)',
            'config' => [
                'type' => 'input',
                'size' => 20,
                'max' => 30,
                'required' => false,
                'eval' => 'trim',
            ],
        ],
        'bodytext' => [
            'label' => 'Text',
            'config' => [
                'type' => 'text',
                'enableRichtext' => true,
                'richtextConfiguration' => 'minimal',
            ],
        ],
        'records' => [
            'label' => 'Content record',
            'config' => [
                'type' => 'group',
                'allowed' => 'tt_content',
                'maxitems' => 1,
                'minitems' => 0,
                'size' => 1,
                // 'suggestOptions' => [
                //     'default' => [
                //         'additionalSearchFields' => 'nav_title, url',
                //         'addWhere' => 'AND pages.doktype = 1',
                //     ],
                // ],
            ],
        ],
        'headercell' => [
            'exclude' => 1,
            'label' => 'Header cell',
            'config' => [
                'type' => 'check',
                'items' => [
                    [
                        'Header cell',
                    ],
                ],
            ],
        ],
        'scope' => [
            'exclude' => 1,
            'label' => 'scope',
            'displayCond' => 'FIELD:headercell:REQ:true',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    [
                        'label' => 'none',
                        'value' => '',
                    ],
                    [
                        'label' => 'row',
                        'value' => 'row',
                    ],
                    [
                        'label' => 'col',
                        'value' => 'col',
                    ],
                    [
                        'label' => 'rowgroup',
                        'value' => 'rowgroup',
                    ],
                    [
                        'label' => 'colgroup',
                        'value' => 'colgroup',
                    ],
                    [
                        'label' => 'auto',
                        'value' => 'auto',
                    ],
                ],
                'size' => 1,
            ],
        ],
        'class' => [
            'label' => 'class',
            'config' => [
                'type' => 'input',
                'size' => 20,
                'max' => 30,
                'required' => false,
                'eval' => 'trim',
            ],
        ],
        'abbr' => [
            'exclude' => 1,
            'label' => 'Abbr',
            'config' => [
                'type' => 'input',
                'size' => 20,
                'max' => 30,
                'required' => false,
                'eval' => 'trim',
            ],
        ],
        'headers' => [
            'exclude' => 1,
            'label' => 'headers',
            'config' => [
                'type' => 'input',
                'size' => 20,
                'max' => 30,
                'required' => false,
                'eval' => 'trim',
            ],
        ],
        'id' => [
            'exclude' => 1,
            'label' => 'id',
            'config' => [
                'type' => 'input',
                'size' => 20,
                'max' => 30,
                'required' => false,
                'eval' => 'trim',
            ],
        ],
        'rowspan' => [
            'exclude' => 1,
            'label' => 'rowspan',
            'config' => [
                // 'type' => 'number', v12
                'type' => 'input',
                'eval' => 'int',
                'size' => 2,
            ],
        ],
        'colspan' => [
            'exclude' => 1,
            'label' => 'colspan',
            'config' => [
                // 'type' => 'number', v12
                'type' => 'input',
                'eval' => 'int',
                'size' => 2,
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
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.visible',
            'config' => [
                'type' => 'check',
                'renderType' => 'checkboxToggle',
                'items' => [
                    [
                        0 => 'Visible',
                        'labelChecked' => 'Enabled',
                        'labelUnchecked' => 'Disabled',
                        'invertStateDisplay' => true,
                    ],
                ],
            ],
        ],
    ],
    'palettes' => [
        'palette' => [
            'label' => 'Celldata',
            'showitem' => 'headercell, scope, hidden',
        ],
        'palette_spans' => [
            'label' => 'Span attributes',
            'showitem' => 'rowspan, colspan',
        ],
        'palette_attributes' => [
            'label' => 'Further attributes',
            'showitem' => 'class, abbr, id, headers',
        ],
    ],
    'types' => [
        '0' => ['showitem' => '
            --div--;LLL:EXT:htmltables/Resources/Private/Language/locallang_tabs.xlf:general,
                --palette--;;palette, bodytext, records,
            --div--;LLL:EXT:htmltables/Resources/Private/Language/locallang_tabs.xlf:attributes,
                --palette--;;palette_attributes,
            --div--;LLL:EXT:htmltables/Resources/Private/Language/locallang_tabs.xlf:spans,
                --palette--;;palette_spans,
        '],
    ],
];
