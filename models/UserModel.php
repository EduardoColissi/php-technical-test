<?php

class UserModel extends Database{
    private $pdo;

    public function __construct() {
        $this->pdo = $this->getConnection();
    }
    public function fetchAll() {
        $query = $this->pdo->query("SELECT * FROM users");
        if ($query->rowCount() > 0) {
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } else {
            return [];
        }
    }

    public function createInitialData() {
        $query = $this->pdo->prepare("INSERT INTO users (name, email, status, admission_date) VALUES (:name, :email, :status, :admission_date)");
        $query->execute([
            'name' => 'John Doe',
            'email' => 'jdoe@gmail.com',
            'status' => 0,
            'admission_date' => '2024-03-15',
        ]);

        $query->execute([
            'name' => 'Jane Doe',
            'email' => 'jane@outlook.com',
            'status' => 1,
            'admission_date' => '2022-05-19',
        ]);
    }
}