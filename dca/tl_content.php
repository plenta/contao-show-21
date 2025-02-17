<?php

declare(strict_types=1);

$GLOBALS['TL_DCA']['tl_content']['palettes']['info_box'] = '
    {type_legend},type,headline,subHeadline;
    {info_box_legend},text,url,target,linkTitle,titleText;
    {template_legend:hide},customTpl;
    {protected_legend:hide},protected;
    {expert_legend:hide},cssID;
    {invisible_legend:hide},invisible,start,stop
';

$GLOBALS['TL_DCA']['tl_content']['fields']['subHeadline'] = [
    "inputType" => "text",
    "eval" => ['tl_class' => 'w50'],
    "sql" => "varchar(255) NOT NULL default ''",
];
