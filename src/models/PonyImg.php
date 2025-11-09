<?php

namespace models;

use models\Model;

class PonyImg extends Model
{
    public function getAll(): array {
        $stmt = $this->prepare("SELECT * FROM ponies");
        $stmt->execute();
        return $stmt->fetchAll();
    }
}