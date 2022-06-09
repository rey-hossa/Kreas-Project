<?php

return $routes = [
    'GET' => [
        'projects/kreas/product' => 'controller/product/read.php',
        'projects/kreas/order' => 'controller/order/read.php',

        'projects/kreas/co2tot' => 'controller/filters/co2tot.php',
        'projects/kreas/forcountry' => 'controller/filters/forcountry.php',
        'projects/kreas/forproduct' => 'controller/filters/forproduct.php',

        'projects/kreas/' => 'index.php',
    ],
    'POST' => [
        'projects/kreas/product' => 'controller/product/create.php',
        'projects/kreas/order' => 'controller/order/create.php',

        'projects/kreas/fortemp' => 'controller/filters/fortemp.php',
    ],
    'PUT' => [
        'projects/kreas/product' => 'controller/product/update.php',
        'projects/kreas/order' => 'controller/order/update.php',
    ],
    'DELETE' => [
        'projects/kreas/product' => 'controller/product/delete.php',
        'projects/kreas/order' => 'controller/order/delete.php',
    ]
];
