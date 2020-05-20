<?php
$EM_CONF['vhs'] = [
    'title' => 'VHS: Fluid ViewHelpers',
    'description' => 'A collection of ViewHelpers to perform rendering tasks which are not natively supported by Fluid - for example: advanced formatters, math calculators, specialized conditions and Iterator/Array calculators and processors',
    'version' => '7.0.0',
    'category' => 'misc',
    'state' => 'stable',
    'uploadfolder' => false,
    'clearCacheOnLoad' => false,
    'author' => 'FluidTYPO3 Team',
    'author_email' => 'claus@namelesscoder.net',
    'author_company' => '',
    'constraints' => [
        'depends' => [
            'php' => '7.0.0-7.4.99',
            'typo3' => '8.7.0-10.4.99',
        ],
        'conflicts' => [],
        'suggests' => [],
    ],
    'autoload' => [
        'psr-4' => [
            'FluidTYPO3\\Vhs\\' => 'Classes/',
        ],
    ],
    'autoload-dev' => [
        'psr-4' => [
            'FluidTYPO3\\Vhs\\Tests\\' => 'Tests/',
        ],
    ],
];
