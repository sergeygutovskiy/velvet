<?php

namespace App;
use PDO;
use PDOException;

class DB {
    public static function get_connection()
    {
        $host = '127.0.0.1';
        $db   = 'velvet';
        $user = 'root';
        $password = 'root';
        $charset = 'utf8';
    
        $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
        $opt = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];
    
        try {
            return new PDO($dsn, $user, $password, $opt);
        } catch (PDOException $e) {
            die('Подключение не удалось: ' . $e->getMessage());
        }
    }
}
