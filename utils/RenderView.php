<?php

class RenderView {
    public function loadView($view, $args) {
        extract($args);
        require_once __DIR__ . "/../views/$view.php";
    }

    public function loadModal($title, $action) {
        $this->loadView('formModal', [
            'title' => $title,
            'action' =>  $action         
        ]);
    }
}