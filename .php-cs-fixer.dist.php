<?php

$finder = (new PhpCsFixer\Finder())
    ->in(__DIR__.'/src')
    ->in(__DIR__.'/core')
;

return (new PhpCsFixer\Config())
    ->setRules([
        '@Symfony' => true,
        'array_syntax' => ['syntax' => 'short'],
        'phpdoc_annotation_without_dot' => false,
        'phpdoc_summary' => false,
        'yoda_style' => false,
        'global_namespace_import' => false,
        'unary_operator_spaces' => false
    ])
    ->setFinder($finder)
    ;