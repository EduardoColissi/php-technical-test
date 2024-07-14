<?php

class UserController {
    public function index() {
        echo 'Home';
    }

    public function testeComParametro($id) {
        echo 'testeComParametro' . $id;
    }

    public function testeComQuery($id, $nome, $email, $senha){
        echo 'testeComQuery:' . $id . $nome . $email . $senha;
    }

    public function testeAction() {
        echo 'Load';
    }
}