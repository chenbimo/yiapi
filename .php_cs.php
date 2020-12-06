<?php

$finder = PhpCsFixer\Finder::create()
    ->exclude('vendor')
    ->notPath('src/Symfony/Component/Translation/Tests/fixtures/resources.php')
    ->in(__DIR__)
;

return PhpCsFixer\Config::create()
    ->setRules([
        '@PSR2' => true,
        '@PhpCsFixer' => true,
        'array_syntax' => ['syntax' => 'short'],
        'braces' => [
            'position_after_functions_and_oop_constructs' => 'same',
        ],
        'single_quote' => [
            'strings_containing_single_quote_chars' => false,
        ],
        'concat_space' => [
            'spacing' => 'one',
        ],
        'return_assignment' => false,
        'no_unused_imports' => false,
        'no_unneeded_curly_braces' => false,
        'no_useless_else' => false,
        'phpdoc_annotation_without_dot' => true,
        'phpdoc_summary' => false,
        'no_null_property_initialization' => false,
        'ordered_class_elements' => [
            'order' => [],
            'sortAlgorithm' => 'none',
        ],
        'yoda_style' => [
            'identical' => false,
            'equal' => false,
        ],
    ])
    ->setFinder($finder)
;
