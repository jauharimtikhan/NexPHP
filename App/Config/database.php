<?php

return [
    'database' => [
        'driver' => $_ENV['DB_DRIVER'] ? $_ENV['DB_DRIVER'] : 'mysql', // or 'sqlite'
        'host' => $_ENV['DB_HOSTNAME'] ? $_ENV['DB_HOSTNAME'] : 'localhost',
        'database' => $_ENV['DB_NAME'] ? $_ENV['DB_NAME'] : 'my_pos',
        'username' => $_ENV['DB_USER'] ? $_ENV['DB_USER'] : 'root',
        'password' => $_ENV['DB_PASSWORD'] ? $_ENV['DB_PASSWORD'] : '',
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
        'prefix' => '',
        'options' => [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ],
    ]
];
