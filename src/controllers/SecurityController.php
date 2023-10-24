<?php

require_once 'AppController.php';
require_once __DIR__.'/../models/User.php';

class SecurityController extends AppController
{
    public function login(){
        $user = new User('email@email.com', 'password', 'Jaja', 'surname');

        $email = $_POST["email"];
        $password = $_POST["password"];
        if ($user->getEmail() == $email &&  $user->getPassword() == $password) {
            $response = ['success' => true];
        }
        else {
            $response = ['success' => false, 'message' => 'Błąd logowania. Sprawdź dane.'];
        }
        header('Content-Type: application/json');
        echo json_encode($response);


        #$url = "http://$_SERVER[HTTP_HOST]";
        #header("Location: {$url}/shop");
    }
}