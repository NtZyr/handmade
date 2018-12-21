<?php

return [
    'name' => '',  // your database name
    'username' => '',  // your database user
    'password' => '', // your database user password
    'connection' => 'mysql:host=127.0.0.1', //your database host
    'options' => [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING
    ],
];