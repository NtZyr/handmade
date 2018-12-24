<?php

namespace Core\Database;

use PDO;

class QueryBuilder
{
    protected $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;

        return $this->pdo;
    }

    public function selectAll($table)
    {
        $query = $this->pdo->prepare("select * from {$table}");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_CLASS);
    }

    public function get($table, $field, $value)
    {
        $query = $this->pdo->prepare("select * from {$table} where {$field} = '{$value}'");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_CLASS);
    }

    public function insert(string $table, array $fields, array $values)
    {
        $bindParams = [];
        $placeholders = [];

        foreach ($values as $field => $value) {
            // if (gettype($value) != 'integer') $values[$key] = "'$value'";
            $placeholders[] = ":$field";
            $bindParams[":$field"] = $value;
        }

        $fields_row = implode(', ', $fields);
        $placeholders_row = implode(', ', $placeholders);

        $query = $this->pdo->prepare("insert into {$table} ({$fields_row}) values ({$placeholders_row})");

        foreach ($bindParams as $field => $value) {
            $query->bindValue($field, $value);
        }

        return $query->execute();
    }
}