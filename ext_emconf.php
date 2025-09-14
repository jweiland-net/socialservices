<?php

$EM_CONF[$_EXTKEY] = [
    'title' => 'Social Services',
    'description' => 'Manage social services to list them in frontend with a glossary and filter options.',
    'category' => 'plugin',
    'author' => 'Stefan Froemken, Hoja Mustaffa Abdul Latheef',
    'author_email' => 'projects@jweiland.net',
    'author_company' => 'jweiland.net',
    'state' => 'stable',
    'version' => '7.0.0',
    'constraints' => [
        'depends' => [
            'typo3' => '13.4.0-13.4.99',
            'maps2' => '12.0.0-0.0.0',
            'glossary2' => '7.0.0-0.0.0',
        ],
        'conflicts' => [
        ],
        'suggests' => [
        ],
    ],
];
