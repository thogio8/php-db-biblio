<?php

class Database {
    private static ?PDO $connection = null;

    public static function getConnection(): PDO {
        if (self::$connection === null) {
            $dsn = 'mysql:host=localhost;dbname=db_biblio;charset=utf8';
            $username = 'root';
            $password = '';

            self::$connection = new PDO($dsn, $username, $password);
            self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }

        return self::$connection;
    }
}
