<?php
    $EM_CONF[$_EXTKEY] = [
        'title' => 'htmltables',
        'description' => 'This extension adds a new content type to create tables by IRRE/Inline',
        'category' => 'plugin',
        'author' => 'Martin Zarth',
        'author_company' => 'Zarthwork',
        'author_email' => 'martin@zarthwork.de',
        'state' => 'beta',
        'clearCacheOnLoad' => true,
        'version' => '0.9.3',
        'constraints' => [
            'depends' => [
                'typo3' => '12.4.0-12.4.99',
            ]
        ]
    ];
