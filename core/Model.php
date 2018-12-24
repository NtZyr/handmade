<?php

namespace Core;

use Core\Database\QueryBuilder;
use Core\Database\Connection;


class Model
{
    use Relationship;

    protected $connection;
    protected $result;

    public function __construct()
    {
        $this->connection = new QueryBuilder(Connection::make());
        if ($this->result) {
            $result = $this->result;
            return $result;
        }
        return $this;
    }

    public function __set($name, $value)
    {
        $this->$name = $value;
    }

    public function __get($name)
    {
        if ($this->result != null) {
            $result = $this->result[0];
            $this->$name = $result->$name;
            return $this->$name;
        }
    }

    public function save()
    {
        $table = static::$table;
        $connect = $this->connection;
        $fields = $this->fillable;

        foreach ($fields as $field) {
            if ($this->$field != '') {
                $values[$field] = $this->$field;
            } else {
                $key = array_search($field, $fields);
                if ($key !== false) {
                    unset($fields[$key]);
                }
            }
        }

        $result = $connect->insert($table, $fields, $values);
    }

    public static function all()
    {
        $table = static::$table;
        $query = new static;

        $result = $query->connection->selectAll($table);
        $arrayResult = [];

        foreach ($result as $row) {
            $arrayResult[] = $row;
        }

        $query->result = $arrayResult;

        return $query->result;
    }

    public function first()
    {
        return $this->result[0];
    }

    public static function getBy($field, $value)
    {
        $table = static::$table;
        $query = new static;
        $arrayResult = [];

        $result = $query->connection->get($table, $field, $value);

        foreach ($result as $row) {
            $arrayResult[] = $row;
        }
        $query->result = $arrayResult;

        return $query;
    }
}