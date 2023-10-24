<?php

require_once 'AppController.php';

class DefaultController extends AppController {
    public function home() {
        $this->render('home');
    }

    public function shop() {
        $this->render('shop');
    }
    public function login() {
        $this->render('login');
    }
}