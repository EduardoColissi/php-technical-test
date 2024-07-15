<?php

class UserController extends RenderView  {
    private $user;
    
    public function __construct() {
        $this->user = new UserModel();
    }

    public function index() {

        if(empty($this->user->fetchAll())) {
            $this->user->createInitialData();
        }

         $this->loadView('header', [
            'title' => 'header'
        ]);

        $this->loadView('home', [
            'title' => 'Usuários',
            'users' =>  $this->user->fetchAll()
        ]);

        $this->loadView('formModal', [
            'title' => 'Formulário de Usuário',
        ]);

         $this->loadView('footer', [
            'title' => 'footer'
        ]);
    }

    public function add() {

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $status = $_POST['status'];
            $admission_date = $_POST['admission_date'];
            
             $this->user->create([
                'name' => $name,
                'email' => $email,
                'status' => $status,
                'admission_date' => $admission_date
            ]);

            $response = [
                'success' => true,
                'message' => 'Dados recebidos com sucesso!',
                'data' => [
                    'name' => $name,
                    'email' => $email,
                    'status' => $status,
                    'admission_date' => $admission_date
                ]
            ];

            header('Content-Type: application/json');
            echo json_encode($response);
        }
    }

    public function load($name = '', $email = '') {
        header('Content-Type: application/json');
        echo json_encode( $this->user->fetchAll($name, $email));
    }

    public function loadById($id) {
        header('Content-Type: application/json');
        echo json_encode( $this->user->fetchById($id));
    }

    public function update($id) {
        if ($_SERVER["REQUEST_METHOD"] == "PUT") {  
            parse_str(file_get_contents("php://input"), $_PUT);
            $name = $_PUT['name'];
            $email = $_PUT['email'];
            $status = $_PUT['status'];
            $admission_date = $_PUT['admission_date'];
            $updated = new DateTime('now', new DateTimeZone('America/Sao_Paulo'));

             $this->user->update([
                'id' => $id,
                'name' => $name,
                'email' => $email,
                'status' => $status,
                'admission_date' => $admission_date,
                'updated' => $updated->format('Y-m-d H:i:s')
            ]);

            $response = [
                'success' => true,
                'message' => 'Dados atualizados com sucesso!',
                'data' => [
                    'id' => $id,
                    'name' => $name,
                    'email' => $email,
                    'status' => $status,
                    'admission_date' => $admission_date,
                    'updated' => $updated->format('Y-m-d H:i:s')
                ]
            ];

            header('Content-Type: application/json');
            echo json_encode($response);
        }
    }

    public function delete($id) {
         $this->user->delete($id);

        $response = [
            'success' => true,
            'message' => 'Usuário deletado com sucesso!',
            'data' => [
                'id' => $id
            ]
        ];

        header('Content-Type: application/json');
        echo json_encode($response);
    }
}