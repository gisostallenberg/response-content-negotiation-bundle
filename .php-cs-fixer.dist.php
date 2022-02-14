<?php

$config = new PhpCsFixer\Config();

return $config
    ->setRules([
        '@Symfony'               => true,
        'declare_strict_types'   => true,
        'ordered_imports'        => true,
        'psr_autoloading'        => false,
        'yoda_style'             => false,
        'phpdoc_order'           => true,
        'array_syntax'           => [
            'syntax' => 'short',
        ],
        'binary_operator_spaces' => [
            'operators' => [
                '='   => 'align_single_space_minimal',
                '=>'  => 'align_single_space_minimal',
                '===' => 'align_single_space_minimal',
            ],
        ],
        'header_comment'         => [
            'header' => <<<EOH
This file is part of the Response Content Negotiation Bundle package.
(c) Giso Stallenberg.
EOH
                ,
            ]
    ])
    ->setFinder(
        PhpCsFixer\Finder::create()->in([
            __DIR__.'/src',
            __DIR__.'/tests',
        ]
    ));
