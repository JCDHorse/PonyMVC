<?php

namespace PonyMVC\models;

use PDO;

abstract class Model
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    protected function getPdo(): PDO
    {
        return $this->pdo;
    }

    protected function prepare(string $sql): \PDOStatement
    {
        return $this->pdo->prepare($sql);
    }
}