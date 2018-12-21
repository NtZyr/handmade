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

    public function insert(string $table, array $fillable)
    {
        $fields = implode(', ', $fillable);
        foreach ($fillable as $value) {
            $values[] = ":$value";
        }
        $values = implode(', ', $values);
        $query = $this->pdo->prepare("insert into {$table} ($fillable) values ($values)");

        echo "insert into {$table} ($fillable) values ($values)";
    }
}