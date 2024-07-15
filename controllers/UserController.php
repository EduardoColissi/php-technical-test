<?php

class UserController extends RenderView {
    public function index() {
        $users = new UserModel();
        $this->loadView('home', [
            'title' => 'Home',
            'users' => $users->fetch()
        ]);
    }
}