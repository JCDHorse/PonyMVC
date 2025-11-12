<?php

namespace PonyMVC\models;

use PonyMVC\models\Model;

class PonyImg extends Model
{
    public function getAll(): array {
        $stmt = $this->prepare("SELECT * FROM ponies");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function get(int $id): array | false {
        $stmt = $this->prepare("SELECT * FROM ponies WHERE id = :id");
        $stmt->bindParam('id', $id, \PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function newPony(string $src, string $alt): bool {
        $stmt = $this->prepare("INSERT INTO ponies (src, alt) VALUES (:src, :alt)");
        $stmt->bindValue(':src', $src, \PDO::PARAM_STR);
        $stmt->bindValue(':alt', $alt, \PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->rowCount() === 1;
    }

    public function delete(int $id): bool {
        $stmt = $this->prepare("DELETE FROM ponies WHERE id = :id");
        $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->rowCount() === 1;
    }
}