<?php

declare(strict_types=1);

use Contao\DC_Table;
use Contao\DataContainer;

$GLOBALS['TL_DCA']['tl_cars'] = [

    // Config
    'config' => [
        'dataContainer' => DC_Table::class,
        'enableVersioning' => true,
        'sql' => [
            'keys' => [
                'id' => 'primary',
                'tstamp' => 'index'
            ],
        ],
    ],

    // List
    'list' => [
        'sorting' => [
            'mode' => DataContainer::MODE_SORTABLE,
            'fields' => ['tstamp', 'id', 'baujahr'],
            'panelLayout' => 'filter;sort,search,limit',
            'defaultSearchField' => 'marke'
        ],
        'label' => [
            'fields' => ['marke', 'baujahr'],
            'format' => '%s <span class="label-date">[Baujahr: %s]</span>',
        ],
    ],

    'palettes' => [
        'default' => '{car_legend},marke,baujahr;{image_legend},image',
    ],

    // Fields
    'fields' => [
        'id' => [
            'flag' => 12,
            'sql' => "int(10) unsigned NOT NULL auto_increment"
        ],
        'tstamp' => [
            'filter' => true,
            'sorting' => true,
            'flag' => DataContainer::SORT_DAY_DESC,
            'sql' => "int(10) unsigned NOT NULL default 0"
        ],
        'marke' => [
            "inputType" => "text",
            "eval" => ['mandatory' => true, 'tl_class' => 'w50'],
            "sql" => "varchar(255) NOT NULL default ''",
        ],
        'baujahr' => [
            'sorting' => true,
            "inputType" => "text",
            "eval" => ['mandatory' => true, 'rgxp' => 'natural', 'maxlength' => 4, 'tl_class' => 'w50'],
            "sql" => "varchar(4) COLLATE ascii_bin NOT NULL default ''",
        ],
        'image' => [
            'inputType' => 'fileTree',
            'eval' => ['fieldType' => 'radio', 'filesOnly' => true, 'tl_class' => 'clr'],
            'sql' => "binary(16) NULL"
        ],
    ],
];
