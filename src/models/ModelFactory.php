<?php

namespace models;

class ModelFactory
{
    private static \PDO $pdo;

    public static function init(\PDO $pdo): void
    {
        self::$pdo = $pdo;
    }

    public static function getPonyImgModel(): PonyImg
    {
        return new PonyImg(self::$pdo);
    }
}