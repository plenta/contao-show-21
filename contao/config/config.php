<?php

declare(strict_types=1);

use App\Model\CarsModel;

$GLOBALS['BE_MOD']['content']['cars'] = [
    'tables' => ['tl_cars'],
];

$GLOBALS['TL_MODELS']['tl_cars'] = CarsModel::class;
