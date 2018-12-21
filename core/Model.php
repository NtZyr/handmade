<?php

namespace Core;

use Core\Database\QueryBuilder;
use Core\Database\Connection;


class Model
{
    protected $result;
    protected $fields;

    public function __construct()
    {

    }

    public function __set($name, $value)
    {
        $this->fields[$name] = $value;
    }

    public function save()
    {
        $table = static::$table;
        $connect = new QueryBuilder(Connection::make());

        $result = $connect->insert($table, $fillable);
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