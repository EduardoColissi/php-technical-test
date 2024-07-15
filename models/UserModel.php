<?php

class UserModel extends Database{
    private $pdo;

    public function __construct() {
        $this->pdo = $this->getConnection();
    }
    public function fetch() {
        $query = $this->pdo->query("SELECT * FROM users");
        if ($query->rowCount() > 0) {
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } else {
            return [];
        }
    }
}