<?php

require_once 'AppController.php';

class DefaultController extends AppController {
    public function home() {
        $this->render('home');
    }
}