<?php

$EM_CONF[$_EXTKEY] = [
    'title' => 'Social Services',
    'description' => 'Manage social services to list them in frontend with a glossary and filter options.',
    'category' => 'plugin',
    'author' => 'Stefan Froemken',
    'author_email' => 'sfroemken@jweiland.net',
    'author_company' => 'jweiland.net',
    'state' => 'stable',
    'version' => '5.0.0',
    'constraints' => [
        'depends' => [
            'typo3' => '10.4.36-11.5.99',
            'maps2' => '8.0.0-0.0.0',
            'glossary2' => '5.0.0-0.0.0',
        ],
        'conflicts' => [
        ],
        'suggests' => [
        ],
    ],
];
