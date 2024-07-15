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

    public function create($data) {
        $query = $this->pdo->prepare("INSERT INTO users (name, email, status, admission_date) VALUES (:name, :email, :status, :admission_date)");
        $query->execute([
            'name' => $data['name'],
            'email' => $data['email'],
            'status' => $data['status'],
            'admission_date' => $data['admission_date'],
        ]);
    }

    public function fetchById($id) {
        $query = $this->pdo->prepare("SELECT * FROM users WHERE id = :id");
        $query->execute(['id' => $id]);
        if ($query->rowCount() > 0) {
            return $query->fetch(PDO::FETCH_ASSOC);
        } else {
            return;
        }
    }

    public function update($data) {
        $query = $this->pdo->prepare("UPDATE users SET name = :name, email = :email, status = :status, admission_date = :admission_date, updated = :updated WHERE id = :id");
        $query->execute([
            'id' => $data['id'],
            'name' => $data['name'],
            'email' => $data['email'],
            'status' => $data['status'],
            'admission_date' => $data['admission_date'],
            'updated' => $data['updated']
        ]);
    }

    public function delete($id) {
        $query = $this->pdo->prepare("DELETE FROM users WHERE id = :id");
        $query->execute(['id' => $id]);
    }
}