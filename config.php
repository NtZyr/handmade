<?php

return [
    'name' => 'eshop',  // your database name
    'username' => 'homestead',  // your database user
    'password' => 'secret', // your database user password
    'connection' => 'mysql:host=127.0.0.1', //your database host
    'options' => [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING
    ],
];