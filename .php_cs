<?php

$finder = Symfony\CS\Finder::create()
    ->files()
    ->in(__DIR__)
    ->exclude(['vendor', 'build', 'spec'])
    ->name('*.php');

return Symfony\CS\Config\Config::create()
    ->fixers([
        'align_double_arrow',
        'align_equals',
        'concat_with_spaces',
        'header_comment',
        'logical_not_operators_with_successor_space',
        'multiline_spaces_before_semicolon',
        'phpdoc_order',
        'strict',
        'strict_param',
    ])
    ->finder($finder);
