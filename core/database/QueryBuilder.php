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

    public function update(string $table, array $fields, array $values, array $where)
    {
        foreach ($fields as $field) {
            $placeholder[] = "`$field`=:$field";
        }

        $placeholder = implode(', ', $placeholder);

        $query_str = "update `{$table}` set {$placeholder} where `{$where['field']}`=:{$where['field']}";

        $query = $this->pdo->prepare($query_str);

        return $query->execute($values);
    }

    public function delete(string $table, int $id)
    {
        $query = $this->pdo->prepare("delete from `{$table}` where id={$id}");

        return $query->execute();
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

        $query = $this->pdo->prepare("insert into `{$table}` ({$fields_row}) values ({$placeholders_row})");

        foreach ($bindParams as $field => $value) {
            $query->bindValue($field, $value);
        }

        $query->execute();

        $result = $this->pdo->lastInsertId();;

        return $result;
    }
}