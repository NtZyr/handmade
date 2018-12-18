<?php

namespace Core;

use Core\Database\QueryBuilder;
use Core\Database\Connection;


class Model
{
    protected $result;

    public function __construct()
    {

    }

    public static function all()
    {
        $table = static::$table;
        $connect = new QueryBuilder(Connection::make());

        $result = $connect->selectAll($table);
        $arrayResult = [];

        foreach ($result as $row) {
            $arrayResult[] = $row;
        }

        $query = new self;
        $query->result = $arrayResult;

        return $query->result;
    }

    public static function find($id)
    {

    }
}