<?php

$radius = require(__DIR__ . '/radius.php');

return [
    'adminEmail' => 'admin@example.com',
    'radius' => $radius,
    'api' => [
        'paas.cs.ccu.edu.tw' => 'http://localhost/api/',
    ]
];
