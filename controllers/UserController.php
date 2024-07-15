<?php

class UserController extends RenderView {
    public function index() {
        $users = new UserModel();

        if(empty($users->fetchAll())) {
            print_r('Creating initial data');
            $users->createInitialData();
        }

        $this->loadView('home', [
            'title' => 'Home',
            'users' => $users->fetchAll()
        ]);
    }
}