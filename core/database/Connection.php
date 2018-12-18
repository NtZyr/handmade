<?php

namespace Core\Database;

use PDO;

class Connection
{
    protected $config;

    public static function make()
    {
        $config = require 'config.php';
        try {
            return new PDO(
                $config['connection'] . ';dbname=' . $config['name'],
                $config['username'],
                $config['password'],
                $config['options']
            );
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }
}