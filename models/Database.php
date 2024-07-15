<?php

class Database {
    public function getConnection() {
        try{
            $pdo = new PDO("mysql:dbname=php_tech_test;host=localhost", "root", "");
            return $pdo;
        } catch (PDOException $e) {

        }
    }
}