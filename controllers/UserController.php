<?php

class UserController extends RenderView {
    public function index() {
        $users = new UserModel();

        if(empty($users->fetchAll())) {
            $users->createInitialData();
        }

        $this->loadView('home', [
            'title' => 'Usuários',
            'users' => $users->fetchAll()
        ]);
    }
}