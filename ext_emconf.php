<?php
    $EM_CONF[$_EXTKEY] = [
        'title' => 'HTML tables (IRRE)',
        'description' => 'Create sophisticated HTML tables easily using Inline Records (IRRE)',
        'category' => 'plugin',
        'author' => 'Martin Zarth',
        'author_company' => 'Zarthwork',
        'author_email' => 'martin@zarthwork.de',
        'state' => 'stable',
        'clearCacheOnLoad' => true,
        'version' => '1.0.0',
        'constraints' => [
            'depends' => [
                'typo3' => '11.5.0-13.9.99',
            ]
        ]
    ];
